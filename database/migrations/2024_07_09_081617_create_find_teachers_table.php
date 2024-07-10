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
    Schema::create('find_teachers', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('subject');
        $table->string('frequency');
        $table->integer('hourly_rate_min');
        $table->integer('hourly_rate_max');
        $table->string('city');
        $table->json('districts');
        $table->text('details');
        $table->string('connection');
        $table->string('contact_value');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('find_teachers');
    }
};
