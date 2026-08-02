<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Question;
use App\Models\ClassRoom;
use Illuminate\Http\Request;

class ArchiveController extends Controller
{
    public function index()
    {
        $authUser = auth()->user()->role_id;

        $query = Question::with(['user', 'teacher', 'topic'])
            ->where('status', 'accepted')
            ->orderBy('updated_at', 'DESC');

        if ($authUser == 2) {
            $query->where('teacher_id', auth()->id());
        }

        $questions = $query->paginate(10);

        return view('admin.archive.index', [
            'questions' => $questions,
            'classes'   => ClassRoom::all()
        ]);
    }

    public function show($id)
    {
        $authUser = auth()->user()->role_id;

        $query = Question::with(['user', 'teacher', 'topic', 'answers.user']);

        if ($authUser == 2) {
            $query->where('teacher_id', auth()->id());
        }

        $question = $query->findOrFail($id);

        return view('admin.archive.show', [
            'question'  => $question
        ]);
    }

    public function filterData(Request $request)
    {
        $classId  = $request->input('class_id');
        $authUser = auth()->user()->role_id;

        $query = Question::with(['user', 'teacher', 'topic'])
            ->where('status', 'accepted')
            ->orderBy('updated_at', 'DESC');

        if ($authUser == 2) {
            $query->where('teacher_id', auth()->id());
        }

        if ($request->filled('class_id')) {
            $userIds = User::where('class_id', $classId)->pluck('id');
            $query->whereIn('user_id', $userIds);
        }

        $questions = $query->paginate(10)->withQueryString();
        $classes   = ClassRoom::all();

        return view('admin.archive.index', compact('questions', 'classes'));
    }
}
