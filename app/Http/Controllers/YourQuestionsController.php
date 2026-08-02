<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Answer;
use App\Models\Question;
use App\Models\Registration;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class YourQuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.your-questions.index', [
            'questions' => Question::with(['user', 'teacher', 'topic'])
                ->where('user_id', auth()->id())
                ->latest()
                ->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $studentId = auth()->id();
        $registrations = Registration::where('student_id', $studentId)->with('topic', 'teacher')->first();

        return view('admin.your-questions.create', [
            'registrations' => $registrations,
            'teachers'      => User::where('role_id', '2')->select('id', 'name', 'role_id')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'teacher_id'    => 'required|exists:users,id',
            'topic_id'      => 'required|exists:topics,id',
            'title'         => 'required|string|max:255',
            'body'          => 'required',
            'file'          => 'required|mimes:docx,doc,pdf|max:10240'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $file       = $request->file('file');
        $filePath   = $file->store('file-questions', 'public');

        Question::create([
            'teacher_id'    => $request->input('teacher_id'),
            'topic_id'      => $request->input('topic_id'),
            'title'         => $request->input('title'),
            'body'          => $request->input('body'),
            'file'          => $filePath,
            'user_id'       => auth()->id()
        ]);

        return redirect('/admin/your-questions')->with('success', 'Successfully added new data');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $question = Question::where('user_id', auth()->id())
            ->with(['answers.user', 'teacher', 'topic'])
            ->findOrFail($id);

        return view('admin.your-questions.show', [
            'question'  => $question,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $question = Question::where('user_id', auth()->id())->findOrFail($id);
        $teacher  = User::where('role_id', '2')->select('id', 'name')->get();

        return view('admin.your-questions.edit', [
            'teachers'  => $teacher,
            'question'  => $question
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $question = Question::where('user_id', auth()->id())->findOrFail($id);

        $validator = Validator::make($request->all(), [
            'teacher_id'    => 'required|exists:users,id',
            'topic_id'      => 'required|exists:topics,id',
            'title'         => 'required|string|max:255',
            'body'          => 'required',
            'file'          => 'nullable|mimes:docx,doc,pdf|max:10240'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $updateData = [
            'teacher_id'    => $request->input('teacher_id'),
            'topic_id'      => $request->input('topic_id'),
            'title'         => $request->input('title'),
            'body'          => $request->input('body'),
        ];

        if ($request->hasFile('file')) {
            $file       = $request->file('file');
            $filePath   = $file->store('file-questions', 'public');

            if ($question->file) {
                Storage::disk('public')->delete($question->file);
            }

            $updateData['file'] = $filePath;
        }

        $question->update($updateData);

        return redirect('/admin/your-questions')->with('success', 'Successfully updated data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $question = Question::where('user_id', auth()->id())->findOrFail($id);
        
        if ($question->file) {
            Storage::disk('public')->delete($question->file);
        }

        $question->delete();

        return redirect()->back()->with('success', 'Successfully deleted data!');
    }

    /**
     * Store an answer to storage.
     */
    public function answer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'body'          => 'required',
            'file'          => 'nullable|mimes:doc,docx,pdf|max:10240',
            'question_id'   => 'required|exists:questions,id'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Verify question belongs to authenticated student
        $question = Question::where('user_id', auth()->id())->findOrFail($request->question_id);

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

        return redirect()->back()->with('success', 'Successfully sent your answer');
    }
}
