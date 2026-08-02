<?php

namespace Tests\Feature;

use App\Models\Question;
use App\Models\Role;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SecurityAndAuthorizationTest extends TestCase
{
    use RefreshDatabase;

    protected User $studentA;
    protected User $studentB;
    protected User $teacherA;
    protected User $teacherB;
    protected Question $questionStudentA;
    protected Topic $topicTeacherA;

    protected function setUp(): void
    {
        parent::setUp();

        $roleTeacher = Role::factory()->teacher()->create();
        $roleStudent = Role::factory()->student()->create();

        $this->teacherA = User::factory()->create(['role_id' => $roleTeacher->id]);
        $this->teacherB = User::factory()->create(['role_id' => $roleTeacher->id]);

        $this->studentA = User::factory()->create(['role_id' => $roleStudent->id]);
        $this->studentB = User::factory()->create(['role_id' => $roleStudent->id]);

        $this->topicTeacherA = Topic::factory()->create(['teacher_id' => $this->teacherA->id]);

        $this->questionStudentA = Question::factory()->create([
            'user_id' => $this->studentA->id,
            'teacher_id' => $this->teacherA->id,
            'topic_id' => $this->topicTeacherA->id,
            'title' => 'Pertanyaan Mahasiswa A',
        ]);
    }

    // --- IDOR Tests (Restricted Scoping Returns 404 Not Found) ---

    public function test_student_cannot_view_other_student_question_detail(): void
    {
        // Mahasiswa B mencoba melihat detail bimbingan Mahasiswa A
        $response = $this->actingAs($this->studentB)->get('/admin/your-questions/' . $this->questionStudentA->id);

        $response->assertNotFound();
    }

    public function test_student_cannot_edit_other_student_question(): void
    {
        $response = $this->actingAs($this->studentB)->get('/admin/your-questions/' . $this->questionStudentA->id . '/edit');

        $response->assertNotFound();
    }

    public function test_student_cannot_update_other_student_question(): void
    {
        $response = $this->actingAs($this->studentB)->put('/admin/your-questions/' . $this->questionStudentA->id, [
            'teacher_id' => $this->teacherA->id,
            'topic_id' => $this->topicTeacherA->id,
            'title' => 'Judul Dihajak Mahasiswa B',
            'body' => 'Isi Dihajak',
        ]);

        $response->assertNotFound();
    }

    public function test_student_cannot_delete_other_student_question(): void
    {
        $response = $this->actingAs($this->studentB)->delete('/admin/your-questions/' . $this->questionStudentA->id);

        $response->assertNotFound();
    }

    public function test_teacher_cannot_approve_other_teacher_guidance_question(): void
    {
        // Dosen B mencoba menyetujui (approve) pertanyaan bimbingan Dosen A
        $response = $this->actingAs($this->teacherB)->post("/questions/{$this->questionStudentA->id}/approve");

        $response->assertNotFound();
    }

    // --- Role Bypass Tests ---

    public function test_student_cannot_access_teacher_routes(): void
    {
        $response = $this->actingAs($this->studentA)->get('/admin/questions-to-answer');
        $response->assertForbidden();

        $massMsgResponse = $this->actingAs($this->studentA)->get('/admin/mass-messaging');
        $massMsgResponse->assertForbidden();
    }

    public function test_student_cannot_access_admin_routes(): void
    {
        $response = $this->actingAs($this->studentA)->get('/admin/teachers');
        $response->assertForbidden();

        $studentMgmtResponse = $this->actingAs($this->studentA)->get('/admin/students');
        $studentMgmtResponse->assertForbidden();
    }

    public function test_teacher_cannot_access_admin_routes(): void
    {
        $response = $this->actingAs($this->teacherA)->get('/admin/teachers');
        $response->assertForbidden();

        $classResponse = $this->actingAs($this->teacherA)->get('/admin/class');
        $classResponse->assertForbidden();
    }
}
