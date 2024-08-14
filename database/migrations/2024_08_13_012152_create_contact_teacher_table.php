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
        Schema::create('contact_teacher', function (Blueprint $table) {
            $table->id();  // 自增 ID
            $table->unsignedInteger('be_teacher_id');  // 關聯到 be_teachers 表的外鍵
            $table->unsignedBigInteger('user_id');  // 關聯到 users 表的外鍵
            $table->timestamps();  // 自動生成 created_at 和 updated_at 欄位

            // 外鍵約束
            $table->foreign('be_teacher_id')->references('id')->on('be_teachers')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('contact_teacher');
    }
};
