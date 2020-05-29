<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCpsUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cps_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('roles');
            $table->string('introduction');
            $table->string('email');
            $table->string('password');
            $table->dateTime('last_login');
            $table->index('email', 'idx_email');
            $table->timestamps();
        });
        Schema::create('cps_user_codes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cps_user_id');
            $table->string('code');
            $table->timestamps();
            $table->index(['cps_user_id', 'code'], 'idx_cps_user_id_and_code');
        });
        Schema::create('cps_bring_users', function (Blueprint $table) { 
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('cps_user_code_id');
            $table->boolean('bought');
            $table->timestamps();
            $table->index('cps_user_code_id', 'idx_cps_user_code_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cps_users');
        Schema::dropIfExists('cps_user_codes');
        Schema::dropIfExists('cps_bring_users');
    }
}
