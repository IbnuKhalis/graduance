<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Models\Registration;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function index()
    {
        $existingRegistration = Registration::with(['topic', 'teacher'])
            ->where('student_id', auth()->user()->id)
            ->first();

        return view('admin.registration.index', [
            'existingRegistration' => $existingRegistration,
            'topics'               => $existingRegistration ? collect() : Topic::with('teacher')->orderBy('id', 'DESC')->get(),
        ]);
    }

    public function confirmRegistration($topicId)
    {
        $studentId = auth()->user()->id;

        $existing = Registration::where('student_id', $studentId)->first();
        if ($existing) {
            return redirect('/admin/registration')->with('error', 'You have already registered a thesis topic!');
        }

        $topic = Topic::findOrFail($topicId);

        $registration = new Registration();
        $registration->student_id   = $studentId;
        $registration->topic_id     = $topicId;
        $registration->teacher_id   = $topic->teacher_id;
        $registration->save();

        return redirect('/admin/registration')->with('success', 'Registration Thesis Successfully !');
    }
}
