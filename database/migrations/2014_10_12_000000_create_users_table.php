<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('last')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('color')->nullable();
            $table->string('avatar')->nullable()->default('default.jpg');
            $table->string('status')->nullable()->default('activo');
            $table->double('goal_amount')->nullable();
            $table->double('comission_percentage')->nullable();
            $table->json('permissions')->nullable();
            $table->string('phone')->unique()->nullable();
            $table->string('job_position')->nullable();
            $table->string('sub_job_position')->nullable();
            $table->date('birth_date')->nullable();
            $table->date('entry_date')->nullable();
            $table->date('departure_date')->nullable();
            $table->double('daily_salary')->nullable();
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->text('profile_photo_path')->nullable();
            $table->boolean('first_time_login')->default(1);
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
        Schema::dropIfExists('users');
    }
}
