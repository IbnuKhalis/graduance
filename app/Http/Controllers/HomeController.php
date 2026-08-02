<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Answer;
use App\Models\Message;
use App\Models\Question;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\ReminderMessage;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user   = auth()->user();
        $roleId = (int) $user->role_id;

        // Default stats variables
        $questionsAll       = 0;
        $todayQuestions     = 0;
        $teachers           = 0;
        $students           = 0;
        $answersAll         = 0;
        $questionsPerDay    = [];
        $answersPerDay      = [];
        $studentQuestion    = 0;
        $answerYourQuestion = 0;
        $teacherAnswer      = 0;
        $questionPending    = 0;
        $studentMentored    = 0;
        $reminderMessages   = collect();

        // Feed pemberitahuan umum
        $notifications = Notification::orderBy('id', 'DESC')->paginate(10);

        if ($roleId === 1) {
            // Metrics khusus Admin (dengan Cache 5 menit untuk agregasi global)
            $questionsAll   = Cache::remember('dash_q_all', 300, fn () => Question::count());
            $todayQuestions = Question::whereDate('created_at', Carbon::today())->count();
            $teachers       = Cache::remember('dash_teachers_count', 300, fn () => User::where('role_id', '2')->count());
            $students       = Cache::remember('dash_students_count', 300, fn () => User::where('role_id', '3')->count());
            $answersAll     = Cache::remember('dash_a_all', 300, fn () => Answer::count());

            $questionsPerDay = Question::select(DB::raw('COUNT(*) as count'), DB::raw('DAYNAME(created_at) as day'))
                ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                ->groupBy('day')
                ->orderBy('day', 'ASC')
                ->pluck('count', 'day')->toArray();

            $answersPerDay = Answer::select(DB::raw('COUNT(*) as count'), DB::raw('DAYNAME(created_at) as day'))
                ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                ->groupBy('day')
                ->orderBy('day', 'ASC')
                ->pluck('count', 'day')->toArray();

        } elseif ($roleId === 2) {
            // Metrics khusus Dosen / Teacher
            $reminderMessages = ReminderMessage::where('teacher_id', $user->id)
                ->orderBy('id', 'DESC')
                ->paginate(10);

            $teacherAnswer   = Answer::where('user_id', $user->id)->count();
            $questionPending = Question::where('teacher_id', $user->id)->doesntHave('answers')->count();
            $studentMentored = User::whereHas('questions', function ($query) use ($user) {
                $query->where('teacher_id', $user->id);
            })->count();

        } elseif ($roleId === 3) {
            // Metrics khusus Mahasiswa / Student
            $studentQuestion = Question::where('user_id', $user->id)->count();
            $answerYourQuestion = Answer::whereHas('question', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->count();
        }

        return view('admin.home', [
            'notifications'     => $notifications,
            'reminderMessages'  => $reminderMessages,
            'questionsAll'      => $questionsAll,
            'todayQuestions'    => $todayQuestions,
            'teachers'          => $teachers,
            'students'          => $students,
            'answersAll'        => $answersAll,
            'questionsPerDay'   => $questionsPerDay,
            'answersPerDay'     => $answersPerDay,
            'studentQuestion'   => $studentQuestion,
            'answerYourQuestion' => $answerYourQuestion,
            'teacherAnswer'     => $teacherAnswer,
            'questionPending'   => $questionPending,
            'studentMentored'   => $studentMentored,
        ]);
    }
}
