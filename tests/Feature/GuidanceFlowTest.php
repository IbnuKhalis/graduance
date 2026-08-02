<?php

namespace Tests\Feature;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Role;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class GuidanceFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_student_can_view_their_questions(): void
    {
        $roleStudent = Role::factory()->student()->create();
        $student = User::factory()->create(['role_id' => $roleStudent->id]);

        $response = $this->actingAs($student)->get('/admin/your-questions');

        $response->assertStatus(200);
    }

    public function test_student_can_submit_guidance_question(): void
    {
        Storage::fake('public');

        $roleTeacher = Role::factory()->teacher()->create();
        $roleStudent = Role::factory()->student()->create();

        $teacher = User::factory()->create(['role_id' => $roleTeacher->id]);
        $student = User::factory()->create(['role_id' => $roleStudent->id]);
        $topic = Topic::factory()->create(['teacher_id' => $teacher->id]);

        $file = UploadedFile::fake()->create('thesis_chapter1.pdf', 100, 'application/pdf');

        $response = $this->actingAs($student)->post('/admin/your-questions', [
            'teacher_id' => $teacher->id,
            'topic_id' => $topic->id,
            'title' => 'Bab 1 Revisi Latar Belakang',
            'body' => 'Berikut adalah draf Bab 1 untuk direvisi.',
            'file' => $file,
        ]);

        $response->assertRedirect('/admin/your-questions');
        $this->assertDatabaseHas('questions', [
            'title' => 'Bab 1 Revisi Latar Belakang',
            'user_id' => $student->id,
            'teacher_id' => $teacher->id,
            'topic_id' => $topic->id,
            'status' => 'revision',
        ]);
    }

    public function test_teacher_can_view_and_answer_guidance_question(): void
    {
        $roleTeacher = Role::factory()->teacher()->create();
        $roleStudent = Role::factory()->student()->create();

        $teacher = User::factory()->create(['role_id' => $roleTeacher->id]);
        $student = User::factory()->create(['role_id' => $roleStudent->id]);
        $topic = Topic::factory()->create(['teacher_id' => $teacher->id]);

        $question = Question::factory()->create([
            'user_id' => $student->id,
            'teacher_id' => $teacher->id,
            'topic_id' => $topic->id,
            'status' => 'revision',
        ]);

        $response = $this->actingAs($teacher)->get('/admin/questions-to-answer/' . $question->id);
        $response->assertStatus(200);

        $answerResponse = $this->actingAs($teacher)->post('/admin/questions-to-answer/' . $question->id, [
            'question_id' => $question->id,
            'body' => 'Perbaiki rumusan masalah pada poin kedua.',
        ]);

        $answerResponse->assertRedirect();
        $this->assertDatabaseHas('answers', [
            'question_id' => $question->id,
            'user_id' => $teacher->id,
            'body' => 'Perbaiki rumusan masalah pada poin kedua.',
        ]);
    }

    public function test_teacher_can_approve_guidance_question(): void
    {
        $roleTeacher = Role::factory()->teacher()->create();
        $roleStudent = Role::factory()->student()->create();

        $teacher = User::factory()->create(['role_id' => $roleTeacher->id]);
        $student = User::factory()->create(['role_id' => $roleStudent->id]);

        $question = Question::factory()->create([
            'user_id' => $student->id,
            'teacher_id' => $teacher->id,
            'status' => 'revision',
        ]);

        $response = $this->actingAs($teacher)->post("/questions/{$question->id}/approve");

        $response->assertRedirect('/admin/questions-to-answer');
        $this->assertDatabaseHas('questions', [
            'id' => $question->id,
            'status' => 'accepted',
        ]);
    }
}
