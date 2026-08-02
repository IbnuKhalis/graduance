<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StudentTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        
        $roleStudent = \App\Models\Role::create(['role' => 'student']);
        $roleTeacher = \App\Models\Role::create(['role' => 'teacher']);
        
        $this->student = User::factory()->create(['role_id' => $roleStudent->id]);
        $this->teacher = User::factory()->create(['role_id' => $roleTeacher->id]);
    }

    public function test_student_can_view_their_questions()
    {
        $response = $this->actingAs($this->student)->get('/admin/your-questions');
        $response->assertStatus(200);
        $response->assertViewIs('admin.your-questions.index');
    }

    public function test_teacher_cannot_view_student_questions_directly()
    {
        $response = $this->actingAs($this->teacher)->get('/admin/your-questions');
        $this->assertTrue(in_array($response->status(), [302, 403, 401]));
    }
}
