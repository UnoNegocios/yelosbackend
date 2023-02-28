<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->string('contents');
            $table->string('name')->nullable();
            $table->string('from');
            $table->string('to');
            $table->string('direction');
            $table->string('channel');
            $table->string('zenvia_timestamp')->nullable();

            $table->bigInteger('conversation_id')->unsigned()->nullable();
            $table->foreign('conversation_id')->references('id')->on('conversations')
            ->onDelete('cascade')
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
        Schema::dropIfExists('messages');
    }
}
