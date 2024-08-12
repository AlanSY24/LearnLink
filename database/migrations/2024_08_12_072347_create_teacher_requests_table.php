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
        Schema::create('teacher_requests', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->index('fk_teacher_requests_users');
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('subject_id');
            $table->longText('available_time');
            $table->date('expected_date');
            $table->integer('hourly_rate_min');
            $table->integer('hourly_rate_max');
            $table->integer('city_id')->index('fk_teacher_requests_cities');
            $table->json('district_ids');
            $table->text('details');
            $table->timestamps();
            $table->enum('status', ['published', 'in_progress', 'completed', 'cancelled'])->default('published');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher_requests');
    }
};
