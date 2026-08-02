<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{
    public function index()
    {
        Message::where('student_id', auth()->user()->id)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        $messages = Message::with('teacher')
            ->where('student_id', auth()->user()->id)
            ->get();

        return view('admin.message.index', [
            'messages' => $messages,
        ]);
    }
}
