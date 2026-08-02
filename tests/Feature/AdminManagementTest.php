<?php

namespace Tests\Feature;

use App\Models\ClassRoom;
use App\Models\Notification;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminManagementTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;
    protected Role $adminRole;
    protected Role $teacherRole;
    protected Role $studentRole;

    protected function setUp(): void
    {
        parent::setUp();

        $this->adminRole = Role::factory()->admin()->create();
        $this->teacherRole = Role::factory()->teacher()->create();
        $this->studentRole = Role::factory()->student()->create();

        $this->admin = User::factory()->create(['role_id' => $this->adminRole->id]);
    }

    public function test_admin_can_manage_teachers(): void
    {
        // Index
        $response = $this->actingAs($this->admin)->get('/admin/teachers');
        $response->assertStatus(200);

        // Store
        $storeResponse = $this->actingAs($this->admin)->post('/admin/teachers', [
            'name' => 'Dr. Budi Santoso',
            'email' => 'budi@university.ac.id',
            'password' => 'password123',
            'role_id' => $this->teacherRole->id,
            'id_number' => '198001012005011001',
            'major' => 'Informatics',
        ]);
        $storeResponse->assertRedirect('/admin/teachers');
        $this->assertDatabaseHas('users', ['email' => 'budi@university.ac.id']);

        // Teacher update & delete
        $teacher = User::where('email', 'budi@university.ac.id')->first();
        $updateResponse = $this->actingAs($this->admin)->put('/admin/teachers/' . $teacher->id, [
            'name' => 'Dr. Budi Santoso, M.Kom',
            'email' => 'budi@university.ac.id',
            'id_number' => '198001012005011001',
            'major' => 'Software Engineering',
        ]);
        $updateResponse->assertRedirect('/admin/teachers');
        $this->assertDatabaseHas('users', ['name' => 'Dr. Budi Santoso, M.Kom']);

        $deleteResponse = $this->actingAs($this->admin)->delete('/admin/teachers/' . $teacher->id);
        $deleteResponse->assertRedirect();
        $this->assertDatabaseMissing('users', ['id' => $teacher->id]);
    }

    public function test_admin_can_manage_classrooms(): void
    {
        // Store
        $response = $this->actingAs($this->admin)->post('/admin/class', [
            'class' => 'Teknik Informatika A',
        ]);

        $response->assertRedirect('/admin/class');
        $this->assertDatabaseHas('class_rooms', ['class' => 'Teknik Informatika A']);
    }

    public function test_admin_can_manage_notifications(): void
    {
        $response = $this->actingAs($this->admin)->post('/admin/notification', [
            'title' => 'Pengumuman Jadwal Bimbingan',
            'notification' => 'Bimbingan pekan ini dimulai pukul 09:00 WIB.',
        ]);

        $response->assertRedirect('/admin/notification');
        $this->assertDatabaseHas('notifications', ['title' => 'Pengumuman Jadwal Bimbingan']);
    }
}
