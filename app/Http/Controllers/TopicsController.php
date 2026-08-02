<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TopicsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.topics.index', [
            'topics'    => Topic::where('teacher_id', auth()->id())->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.topics.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'topic'         => 'required|string|max:255',
            'description'   => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        Topic::create([
            'topic'         => $request->topic,
            'description'   => $request->description,
            'teacher_id'    => auth()->id()
        ]);

        return redirect('/admin/topics')->with('success', 'Successfully added new data');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $topic = Topic::where('teacher_id', auth()->id())->findOrFail($id);

        return view('admin.topics.edit', [
            'topic' => $topic
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $topic = Topic::where('teacher_id', auth()->id())->findOrFail($id);

        $validator = Validator::make($request->all(), [
            'topic'         => 'required|string|max:255',
            'description'   => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $topic->update([
            'topic'         => $request->topic,
            'description'   => $request->description
        ]);

        return redirect('/admin/topics')->with('success', 'Successfully updated data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $topic = Topic::where('teacher_id', auth()->id())->findOrFail($id);
        $topic->delete();

        return redirect()->back()->with('success', 'Successfully deleted data!');
    }
}
