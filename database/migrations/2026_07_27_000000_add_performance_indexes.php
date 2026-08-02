<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->index(['teacher_id', 'status']);
            $table->index(['user_id', 'status']);
        });

        Schema::table('messages', function (Blueprint $table) {
            $table->index(['student_id', 'is_read']);
        });

        Schema::table('reminder_messages', function (Blueprint $table) {
            $table->index('teacher_id');
        });

        Schema::table('registrations', function (Blueprint $table) {
            $table->index('student_id');
            $table->index('teacher_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->dropIndex(['teacher_id', 'status']);
            $table->dropIndex(['user_id', 'status']);
        });

        Schema::table('messages', function (Blueprint $table) {
            $table->dropIndex(['student_id', 'is_read']);
        });

        Schema::table('reminder_messages', function (Blueprint $table) {
            $table->dropIndex(['teacher_id']);
        });

        Schema::table('registrations', function (Blueprint $table) {
            $table->dropIndex(['student_id']);
            $table->dropIndex(['teacher_id']);
        });
    }
};
