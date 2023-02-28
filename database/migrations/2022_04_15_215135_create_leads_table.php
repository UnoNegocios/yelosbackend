<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('last')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('status')->nullable();
            $table->json('additional_data')->nullable();

            $table->bigInteger('origin_id')->unsigned()->nullable();
            $table->foreign('origin_id')->references('id')->on('origins')
            ->onDelete('set null')
            ->onUpdate('cascade');

            $table->bigInteger('conversation_id')->unsigned()->nullable();
            $table->foreign('conversation_id')->references('id')->on('conversations')
            ->onDelete('set null')
            ->onUpdate('cascade');

            $table->bigInteger('funnel_phase_id')->unsigned()->nullable();
            $table->foreign('funnel_phase_id')->references('id')->on('funnel_phases')
            ->onDelete('set null')
            ->onUpdate('cascade');

            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')
            ->onDelete('cascade')
            ->onUpdate('cascade');

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
        Schema::dropIfExists('leads');
    }
}
