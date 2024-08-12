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
        Schema::create('be_teachers', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('user_id')->nullable();
            $table->string('title');
            $table->integer('subject_id')->nullable();
            $table->longText('available_time')->nullable();
            $table->integer('hourly_rate');
            $table->integer('city_id')->nullable();
            $table->longText('district_ids');
            $table->text('details')->nullable();
            $table->integer('resume_id')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->useCurrent();
            $table->enum('status', ['published', 'in_progress', 'completed', 'cancelled'])->default('published');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('be_teachers');
    }
};
