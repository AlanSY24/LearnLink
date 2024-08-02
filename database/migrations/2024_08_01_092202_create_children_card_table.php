<?php
// database/migrations/2024_08_01_000000_create_children_card_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChildrenCardTable extends Migration
{
    public function up()
    {
        Schema::create('children_card', function (Blueprint $table) {
            $table->increments('children_id'); // 設定 children_id 為自動增加的主鍵
            $table->unsignedBigInteger('user_id'); // user_id 列
            $table->string('children_name'); // children_name 列
            $table->date('children_birthdate'); // children_birthdate 列
            $table->enum('children_gender', ['male', 'female', 'other']); // children_gender 列
            
            // 可選：添加外鍵約束（如果有需要的話）
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
            $table->timestamps(); // 自動添加 created_at 和 updated_at 列
        });
    }

    public function down()
    {
        Schema::dropIfExists('children_card');
    }
}
