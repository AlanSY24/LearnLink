<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('teacher_requests', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('subject');
        $table->json('available_time');
        $table->date('expected_date');
        $table->integer('hourly_rate_min');
        $table->integer('hourly_rate_max');
        $table->unsignedBigInteger('city_id');
        $table->json('district_ids');
        $table->text('details');
        $table->timestamps();

        $table->foreign('city_id')->references('id')->on('cities');
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
