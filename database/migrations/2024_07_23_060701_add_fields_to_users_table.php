<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('account')->unique()->nullable();
            $table->string('gender')->nullable();
            $table->string('phone')->nullable();
            $table->date('birthday')->nullable();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('account');
            $table->dropColumn('gender');
            $table->dropColumn('phone');
            $table->dropColumn('birthday');
        });
    }
}
