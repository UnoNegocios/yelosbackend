<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('last')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('job_position')->nullable();

            $table->timestamps();

            $table->bigInteger('company_id')->unsigned()
            ->nullable();
        $table->bigInteger('user_id')->unsigned()
            ->nullable();

            $table->foreign('company_id')->references('id')->on('companies')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        $table->foreign('user_id')->references('id')->on('users')
            ->onDelete('set null')
            ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}
