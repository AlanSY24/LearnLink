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
        Schema::create('contact_student', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_requests_id')->constrained('teacher_requests')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
                        // 防止同一個用戶對同一個老師重複聯絡
                        $table->dropUnique(['user_id']);
                        $table->dropUnique(['be_teacher_id']);
                        $table->unique(['be_teacher_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_student');
    }
};
