<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('favorites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // 指向 users 表
            $table->foreignId('teacher_request_id')->constrained('teacher_requests')->onDelete('cascade'); // 指向 teacher_requests 表
            $table->timestamps();

            // 確保 user_id 和 teacher_request_id 的唯一組合
            $table->unique(['user_id', 'teacher_request_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('favorites');
    }
};
