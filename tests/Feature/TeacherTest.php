<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TeacherTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        
        $roleTeacher = \App\Models\Role::create(['role' => 'teacher']);
        $roleStudent = \App\Models\Role::create(['role' => 'student']);
        
        $this->teacher = User::factory()->create(['role_id' => $roleTeacher->id]);
        $this->student = User::factory()->create(['role_id' => $roleStudent->id]);
    }

    public function test_teacher_can_view_questions_to_answer()
    {
        $response = $this->actingAs($this->teacher)->get('/admin/questions-to-answer');
        $response->assertStatus(200);
        $response->assertViewIs('admin.questions-to-answer.index');
    }

    public function test_teacher_can_view_mentored_students()
    {
        $response = $this->actingAs($this->teacher)->get('/admin/mentored-students');
        $response->assertStatus(200);
        $response->assertViewIs('admin.mentored-students.index');
    }

    public function test_student_cannot_view_questions_to_answer()
    {
        $response = $this->actingAs($this->student)->get('/admin/questions-to-answer');
        $this->assertTrue(in_array($response->status(), [302, 403, 401]));
    }
}
