<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        
        $roleAdmin = \App\Models\Role::create(['role' => 'admin']);
        $roleTeacher = \App\Models\Role::create(['role' => 'teacher']);
        
        $this->admin = User::factory()->create(['role_id' => $roleAdmin->id]);
        $this->teacher = User::factory()->create(['role_id' => $roleTeacher->id]);
    }

    public function test_admin_can_view_students_list()
    {
        $response = $this->actingAs($this->admin)->get('/admin/students');
        $response->assertStatus(200);
        $response->assertViewIs('admin.students.index');
    }

    public function test_admin_can_view_teachers_list()
    {
        $response = $this->actingAs($this->admin)->get('/admin/teachers');
        $response->assertStatus(200);
        $response->assertViewIs('admin.teachers.index');
    }

    public function test_teacher_cannot_view_students_management()
    {
        $response = $this->actingAs($this->teacher)->get('/admin/students');
        $this->assertTrue(in_array($response->status(), [302, 403, 401]));
    }
}
