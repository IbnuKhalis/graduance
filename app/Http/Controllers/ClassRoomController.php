<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClassRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.class.index', [
            'classes'  => ClassRoom::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.class.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'class' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        ClassRoom::create([
            'class' => $request->class
        ]);

        return redirect('/admin/class')->with('success', 'Successfully added new data');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $class = ClassRoom::find($id);
        return view('admin.class.edit', [
            'class' => $class
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $class = ClassRoom::find($id);
        $validator = Validator::make($request->all(), [
            'class' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $class->update([
            'class' => $request->class
        ]);

        return redirect('/admin/class')->with('success', 'Successfully updated data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $class = ClassRoom::find($id);
        $class->delete();

        return redirect()->back()->with('success', 'Successfully deleted data!');
    }
}
