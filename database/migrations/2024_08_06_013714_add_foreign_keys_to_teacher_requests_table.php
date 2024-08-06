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
        Schema::table('teacher_requests', function (Blueprint $table) {
            $table->foreign(['city_id'], 'fk_teacher_requests_cities')->references(['id'])->on('cities')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['user_id'], 'fk_teacher_requests_users')->references(['id'])->on('users')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('teacher_requests', function (Blueprint $table) {
            $table->dropForeign('fk_teacher_requests_cities');
            $table->dropForeign('fk_teacher_requests_users');
        });
    }
};
