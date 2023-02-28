<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShoppingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shoppings', function (Blueprint $table) {
            $table->id();
            $table->string('date')->nullable();
            $table->string('serie')->nullable();
            $table->string('invoice')->nullable();
            $table->string('due_date')->nullable();
            $table->string('notes')->nullable();
            $table->string('pdf')->nullable();
            $table->string('xml')->nullable();

            

            $table->bigInteger('provider_id')->unsigned()->nullable();

            $table->bigInteger('created_by_user_id')->unsigned()->nullable();

            $table->bigInteger('last_updated_by_user_id')->unsigned()->nullable();


            $table->foreign('provider_id')->references('id')->on('providers')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('created_by_user_id')->references('id')->on('users')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('last_updated_by_user_id')->references('id')->on('users')
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
        Schema::dropIfExists('shoppings');
    }
}
