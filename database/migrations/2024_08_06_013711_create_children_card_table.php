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
        Schema::create('children_card', function (Blueprint $table) {
            $table->increments('children_id');
            $table->unsignedBigInteger('user_id')->index('children_card_user_id_foreign');
            $table->string('children_name');
            $table->date('children_birthdate');
            $table->enum('children_gender', ['男', '女', '其他']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('children_card');
    }
};
