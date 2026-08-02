<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Question;

class MentoredStudentsController extends Controller
{
    public function index()
    {
        $teacherId = auth()->id();

        $students = User::whereHas('questions', function ($query) use ($teacherId) {
            $query->where('teacher_id', $teacherId);
        })->paginate(10);

        return view('admin.mentored-students.index', [
            'students' => $students,
        ]);
    }

    public function show($id)
    {
        $teacherId = auth()->id();

        $student = User::where('role_id', '3')
            ->whereHas('questions', function ($query) use ($teacherId) {
                $query->where('teacher_id', $teacherId);
            })
            ->findOrFail($id);

        $questions = Question::with(['topic', 'teacher', 'answers'])
            ->where('user_id', $student->id)
            ->where('teacher_id', $teacherId)
            ->latest()
            ->get();

        return view('admin.mentored-students.show', [
            'student'           => $student,
            'questions'         => $questions,
            'questionsCount'    => $questions->count()
        ]);
    }
}
