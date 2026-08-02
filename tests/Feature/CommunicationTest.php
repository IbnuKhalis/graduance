<?php

namespace Tests\Feature;

use App\Models\Message;
use App\Models\Question;
use App\Models\Role;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommunicationTest extends TestCase
{
    use RefreshDatabase;

    public function test_teacher_can_send_mass_message_to_mentored_students(): void
    {
        $roleTeacher = Role::factory()->teacher()->create();
        $roleStudent = Role::factory()->student()->create();

        $teacher = User::factory()->create(['role_id' => $roleTeacher->id]);
        $student1 = User::factory()->create(['role_id' => $roleStudent->id]);
        $student2 = User::factory()->create(['role_id' => $roleStudent->id]);

        // Students have questions assigned to teacher
        Question::factory()->create(['user_id' => $student1->id, 'teacher_id' => $teacher->id]);
        Question::factory()->create(['user_id' => $student2->id, 'teacher_id' => $teacher->id]);

        $response = $this->actingAs($teacher)->post('/admin/mass-messaging', [
            'message' => 'Pengumuman: Harap kumpulkan revisi sebelum hari Jumat.',
            'student_id' => [$student1->id, $student2->id],
        ]);

        $response->assertRedirect('/admin/mass-messaging');
        $this->assertDatabaseHas('messages', [
            'teacher_id' => $teacher->id,
            'student_id' => $student1->id,
            'message' => 'Pengumuman: Harap kumpulkan revisi sebelum hari Jumat.',
        ]);
    }

    public function test_student_can_view_incoming_messages(): void
    {
        $roleTeacher = Role::factory()->teacher()->create();
        $roleStudent = Role::factory()->student()->create();

        $teacher = User::factory()->create(['role_id' => $roleTeacher->id]);
        $student = User::factory()->create(['role_id' => $roleStudent->id]);

        Message::factory()->create([
            'teacher_id' => $teacher->id,
            'student_id' => $student->id,
            'message' => 'Pesan pengingat bimbingan',
            'is_read' => false,
        ]);

        $response = $this->actingAs($student)->get('/admin/message');

        $response->assertStatus(200);
        $this->assertDatabaseHas('messages', [
            'student_id' => $student->id,
            'is_read' => true,
        ]);
    }

    public function test_student_can_register_for_a_topic(): void
    {
        $roleTeacher = Role::factory()->teacher()->create();
        $roleStudent = Role::factory()->student()->create();

        $teacher = User::factory()->create(['role_id' => $roleTeacher->id]);
        $student = User::factory()->create(['role_id' => $roleStudent->id]);
        $topic = Topic::factory()->create(['teacher_id' => $teacher->id]);

        $response = $this->actingAs($student)->get("/registration/{$topic->id}/confirm");

        $response->assertRedirect();
        $this->assertDatabaseHas('registrations', [
            'student_id' => $student->id,
            'topic_id' => $topic->id,
            'teacher_id' => $teacher->id,
        ]);
    }
}
