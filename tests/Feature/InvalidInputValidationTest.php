<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InvalidInputValidationTest extends TestCase
{
    use RefreshDatabase;

    public function test_submit_guidance_question_fails_without_required_fields(): void
    {
        $roleStudent = Role::factory()->student()->create();
        $student = User::factory()->create(['role_id' => $roleStudent->id]);

        $response = $this->actingAs($student)->post('/admin/your-questions', []);

        $response->assertSessionHasErrors(['teacher_id', 'topic_id', 'title', 'body', 'file']);
    }

    public function test_create_user_fails_with_duplicate_email(): void
    {
        $roleAdmin = Role::factory()->admin()->create();
        $roleTeacher = Role::factory()->teacher()->create();

        $admin = User::factory()->create(['role_id' => $roleAdmin->id]);
        User::factory()->create(['email' => 'existing@university.ac.id']);

        $response = $this->actingAs($admin)->post('/admin/teachers', [
            'name' => 'Dosen Baru',
            'email' => 'existing@university.ac.id', // Duplikat
            'password' => 'password123',
            'role_id' => $roleTeacher->id,
            'id_number' => '12345678',
            'major' => 'Informatics',
        ]);

        $response->assertSessionHasErrors(['email']);
    }

    public function test_profile_update_fails_with_invalid_email_format(): void
    {
        $roleStudent = Role::factory()->student()->create();
        $student = User::factory()->create(['role_id' => $roleStudent->id]);

        $response = $this->actingAs($student)->put('/admin/profile', [
            'name' => 'Nama Baru',
            'email' => 'bukan-format-email', // Invalid email
            'id_number' => '12345678',
            'major' => 'Informatics',
        ]);

        $response->assertSessionHasErrors(['email']);
    }

    public function test_profile_update_fails_with_short_password(): void
    {
        $roleStudent = Role::factory()->student()->create();
        $student = User::factory()->create(['role_id' => $roleStudent->id]);

        $response = $this->actingAs($student)->put('/admin/profile', [
            'name' => 'Nama Baru',
            'email' => 'student@university.ac.id',
            'password' => '12345', // Karakter < 8
            'id_number' => '12345678',
            'major' => 'Informatics',
        ]);

        $response->assertSessionHasErrors(['password']);
    }
}
