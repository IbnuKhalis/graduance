<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ReminderMessage;
use Illuminate\Support\Facades\Validator;

class QuestionController extends Controller
{
    public function index()
    {
        return view('admin.questions.index', [
            'questions' => Question::with(['user.classRoom', 'teacher', 'topic', 'answers'])->orderBy('id', 'DESC')->get()
        ]);
    }

    public function sendMessage($id)
    {
        $question = Question::find($id);
        return view('admin.questions.send-message', [
            'question'  => $question
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'reminder'      => 'required',
            'teacher_id'    => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        ReminderMessage::create([
            'reminder'      => $request->reminder,
            'teacher_id'    => $request->teacher_id
        ]);

        return redirect('/admin/questions')->with('success', 'Successfully added new reminder message');
    }
}
