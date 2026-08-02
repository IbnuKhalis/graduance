<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index()
    {
        return view('admin.profile.index', [
            'profile'   => Auth::user()
        ]);
    }

    public function update(Request $request)
    {
        $profile = Auth::user();
        $validator = Validator::make($request->all(), [
            'name'      => 'required',
            'email'     => 'required|email',
            'password'  => 'nullable|min:8',
            'photo'     => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'id_number' => 'required|numeric',
            'major'     => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $validated = [
            'name'      => $request->input('name'),
            'email'     => $request->input('email'),
            'id_number' => $request->input('id_number'),
            'major'     => $request->input('major')
        ];

        if ($request->filled('password')) {
            $validated['password'] = bcrypt($request->password);
        }

        if ($request->hasFile('photo')) {
            if ($profile->photo) {
                Storage::disk('public')->delete($profile->photo);
            }

            $file = $request->file('photo');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('photos', $fileName, 'public');

            $validated['photo'] = $path;
        }

        $profile->update($validated);

        return redirect()->back()->with('success', 'Successfully updated data');
    }
}
