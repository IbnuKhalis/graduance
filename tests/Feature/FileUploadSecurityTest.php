<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FileUploadSecurityTest extends TestCase
{
    use RefreshDatabase;

    public function test_student_cannot_upload_executable_file_for_guidance(): void
    {
        Storage::fake('public');

        $roleTeacher = Role::factory()->teacher()->create();
        $roleStudent = Role::factory()->student()->create();

        $teacher = User::factory()->create(['role_id' => $roleTeacher->id]);
        $student = User::factory()->create(['role_id' => $roleStudent->id]);
        $topic = Topic::factory()->create(['teacher_id' => $teacher->id]);

        // Malicious executable file pretending to be document
        $forbiddenFile = UploadedFile::fake()->create('malware.php', 100, 'text/x-php');

        $response = $this->actingAs($student)->post('/admin/your-questions', [
            'teacher_id' => $teacher->id,
            'topic_id' => $topic->id,
            'title' => 'Percobaan Upload File Berbahaya',
            'body' => 'Pengujian sistem keamanan file upload.',
            'file' => $forbiddenFile,
        ]);

        $response->assertSessionHasErrors(['file']);
    }

    public function test_student_cannot_upload_exe_file(): void
    {
        Storage::fake('public');

        $roleTeacher = Role::factory()->teacher()->create();
        $roleStudent = Role::factory()->student()->create();

        $teacher = User::factory()->create(['role_id' => $roleTeacher->id]);
        $student = User::factory()->create(['role_id' => $roleStudent->id]);
        $topic = Topic::factory()->create(['teacher_id' => $teacher->id]);

        $exeFile = UploadedFile::fake()->create('payload.exe', 500, 'application/x-msdownload');

        $response = $this->actingAs($student)->post('/admin/your-questions', [
            'teacher_id' => $teacher->id,
            'topic_id' => $topic->id,
            'title' => 'Percobaan Upload Script Executable',
            'body' => 'Pengujian sistem file upload.',
            'file' => $exeFile,
        ]);

        $response->assertSessionHasErrors(['file']);
    }
}
