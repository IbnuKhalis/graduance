<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class QuestionsToAnswer extends Controller
{
    public function index()
    {
        return view('admin.questions-to-answer.index', [
            'questions' => Question::with(['user.classRoom', 'topic'])
                ->where('teacher_id', auth()->id())
                ->where('status', 'revision')
                ->orderBy('updated_at', 'DESC')
                ->paginate(10)
        ]);
    }

    public function show($id)
    {
        $question = Question::where('teacher_id', auth()->id())
            ->with(['answers.user', 'user', 'topic'])
            ->findOrFail($id);

        return view('admin.questions-to-answer.show', [
            'question'  => $question
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'body'          => 'required',
            'file'          => 'nullable|mimes:doc,docx,pdf|max:10240',
            'question_id'   => 'required|exists:questions,id'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Verify question belongs to authenticated teacher
        $question = Question::where('teacher_id', auth()->id())->findOrFail($request->question_id);

        $filePath = null;
        if ($request->hasFile('file')) {
            $file       = $request->file('file');
            $filePath   = $file->store('file-answer', 'public');
        }

        Answer::create([
            'body'          => $request->body,
            'file'          => $filePath,
            'question_id'   => $question->id,
            'user_id'       => auth()->id()
        ]);

        return redirect()->back()->with('success', 'Successfully sent your answer!');
    }

    public function approve(Request $request, $questionId)
    {
        // Verify question belongs to authenticated teacher
        $question = Question::where('teacher_id', auth()->id())->findOrFail($questionId);
        $question->status = 'accepted';
        $question->save();

        return redirect('/admin/questions-to-answer')->with('success', 'The report has been successfully approved! And stored in the archives!');
    }
}
