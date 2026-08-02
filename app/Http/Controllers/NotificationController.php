<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.notification.index', [
            'notifications' => Notification::orderBy('id', 'DESC')->paginate(15)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.notification.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'             => 'required',
            'notification'      => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        Notification::create([
            'title'            => $request->title,
            'notification'     => $request->notification,
            'admin_id'         => auth()->user()->id,
        ]);

        return redirect('/admin/notification')->with('success', 'Successfully added new data');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $notification = Notification::findOrFail($id);
        return view('admin.notification.show', [
            'notification' => $notification
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $notification = Notification::find($id);
        return view('admin.notification.edit', [
            'notification'  => $notification
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $notification = Notification::find($id);
        $validator = Validator::make($request->all(), [
            'title'             => 'required',
            'notification'      => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $notification->update([
            'title'            => $request->title,
            'notification'     => $request->notification,
            'admin_id'         => auth()->user()->id,
        ]);

        return redirect('/admin/notification')->with('success', 'Successfully updated data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $notification = Notification::find($id);
        $notification->delete();

        return redirect()->back()->with('success', 'Successfully deleted data!');
    }
}
