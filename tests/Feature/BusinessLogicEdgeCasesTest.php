<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BusinessLogicEdgeCasesTest extends TestCase
{
    use RefreshDatabase;

    public function test_accessing_non_existent_question_returns_not_found(): void
    {
        $roleStudent = Role::factory()->student()->create();
        $student = User::factory()->create(['role_id' => $roleStudent->id]);

        $response = $this->actingAs($student)->get('/admin/your-questions/9999999');

        $response->assertNotFound();
    }

    public function test_sending_mass_message_fails_without_selecting_students(): void
    {
        $roleTeacher = Role::factory()->teacher()->create();
        $teacher = User::factory()->create(['role_id' => $roleTeacher->id]);

        $response = $this->actingAs($teacher)->post('/admin/mass-messaging', [
            'message' => 'Pesan tanpa memilih mahasiswa',
            // student_id sengaja dikosongkan
        ]);

        $response->assertSessionHasErrors(['student_id']);
    }
}
