<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MassMessagingController extends Controller
{
    public function index()
    {
        $teacherId = auth()->user()->id;
        $students = User::whereHas('questions', function ($query) use ($teacherId) {
            $query->where('teacher_id', $teacherId);
        })->get();

        return view('admin.mass-mesagging.index', [
            'students'  => $students
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required',
            'student_id' => 'required|array',
        ]);

        $selectedStudents = $request->input('student_id');
        $messageText      = $request->input('message');
        $teacherId        = auth()->user()->id;
        $now              = now();

        $messagesData = array_map(function ($studentId) use ($messageText, $teacherId, $now) {
            return [
                'student_id' => $studentId,
                'message'    => $messageText,
                'teacher_id' => $teacherId,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }, $selectedStudents);

        Message::insert($messagesData);

        return redirect('/admin/mass-messaging')->with('success', 'Successfully sent messages');
    }
}
