<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_profile_page_can_be_rendered(): void
    {
        $role = Role::factory()->student()->create();
        $user = User::factory()->create(['role_id' => $role->id]);

        $response = $this->actingAs($user)->get('/admin/profile');

        $response->assertStatus(200);
    }

    public function test_profile_information_can_be_updated(): void
    {
        Storage::fake('public');

        $role = Role::factory()->student()->create();
        $user = User::factory()->create([
            'role_id' => $role->id,
            'name' => 'Old Name',
            'email' => 'old@example.com',
            'id_number' => '12345',
            'major' => 'Informatics',
        ]);

        $file = UploadedFile::fake()->create('avatar.jpg', 100, 'image/jpeg');

        $response = $this->actingAs($user)->put('/admin/profile', [
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
            'id_number' => '54321',
            'major' => 'Computer Science',
            'photo' => $file,
        ]);

        $response->assertRedirect();
        $user->refresh();

        $this->assertEquals('Updated Name', $user->name);
        $this->assertEquals('updated@example.com', $user->email);
        $this->assertEquals('54321', $user->id_number);
        $this->assertEquals('Computer Science', $user->major);
        $this->assertNotNull($user->photo);
    }
}
