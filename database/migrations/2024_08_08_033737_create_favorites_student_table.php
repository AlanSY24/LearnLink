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
        Schema::create('favorites_student', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // 定義 user_id 欄位
            $table->unsignedBigInteger('be_teachers_id'); // 定義 be_teachers_id 欄位
            $table->timestamps();

            // 設置外鍵約束
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); 
            $table->foreign('be_teachers_id')->references('id')->on('be_teachers')->onDelete('cascade'); 

            // 設置唯一鍵
            $table->unique(['user_id', 'be_teachers_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favorites_student');
    }
};
