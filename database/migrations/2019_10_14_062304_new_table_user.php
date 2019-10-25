<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NewTableUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('users_ann', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email',150)->unique();
            $table->string('password',60);
            $table->string('name',20);
            $table->string('admin',1)->default('N'); //admin:Y 
            $table->string('active',1)->default('Y'); //帳號是否開通
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('users_ann');
    }
}
