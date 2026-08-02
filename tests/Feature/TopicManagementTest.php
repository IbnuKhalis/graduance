<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TopicManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_teacher_can_view_topics_index(): void
    {
        $roleTeacher = Role::factory()->teacher()->create();
        $teacher = User::factory()->create(['role_id' => $roleTeacher->id]);
        Topic::factory()->create(['teacher_id' => $teacher->id]);

        $response = $this->actingAs($teacher)->get('/admin/topics');

        $response->assertStatus(200);
    }

    public function test_teacher_can_create_topic(): void
    {
        $roleTeacher = Role::factory()->teacher()->create();
        $teacher = User::factory()->create(['role_id' => $roleTeacher->id]);

        $response = $this->actingAs($teacher)->post('/admin/topics', [
            'topic' => 'AI and Machine Learning',
            'description' => 'Research on Deep Learning Applications',
        ]);

        $response->assertRedirect('/admin/topics');
        $this->assertDatabaseHas('topics', [
            'topic' => 'AI and Machine Learning',
            'teacher_id' => $teacher->id,
        ]);
    }

    public function test_teacher_can_update_topic(): void
    {
        $roleTeacher = Role::factory()->teacher()->create();
        $teacher = User::factory()->create(['role_id' => $roleTeacher->id]);
        $topic = Topic::factory()->create(['teacher_id' => $teacher->id]);

        $response = $this->actingAs($teacher)->put('/admin/topics/' . $topic->id, [
            'topic' => 'Updated Topic Title',
            'description' => 'Updated Description',
        ]);

        $response->assertRedirect('/admin/topics');
        $this->assertDatabaseHas('topics', [
            'id' => $topic->id,
            'topic' => 'Updated Topic Title',
        ]);
    }

    public function test_teacher_can_delete_topic(): void
    {
        $roleTeacher = Role::factory()->teacher()->create();
        $teacher = User::factory()->create(['role_id' => $roleTeacher->id]);
        $topic = Topic::factory()->create(['teacher_id' => $teacher->id]);

        $response = $this->actingAs($teacher)->delete('/admin/topics/' . $topic->id);

        $response->assertRedirect();
        $this->assertDatabaseMissing('topics', ['id' => $topic->id]);
    }
}
