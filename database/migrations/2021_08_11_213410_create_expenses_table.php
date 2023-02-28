<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->string('concept')->nullable();
           
            $table->string('type')->nullable();
            $table->string('serie')->nullable();

            $table->double('amount')->nullable();
            $table->boolean('paid')->nullable();
            $table->date('date')->nullable();

            $table->string('invoice')->nullable();
            $table->date('due_date')->nullable();
            $table->date('payment_date')->nullable();


            $table->string('pdf')->nullable();
            $table->text('notes')->nullable();

            $table->bigInteger('provider_id')->unsigned()->nullable();
            $table->foreign('provider_id')->references('id')->on('providers')
                ->onDelete('set null')
                ->onUpdate('cascade');
            $table->bigInteger('payment_method_id')->unsigned()->nullable();
            $table->foreign('payment_method_id')->references('id')->on('payment_methods')
                ->onDelete('set null')
                ->onUpdate('cascade');
            $table->bigInteger('created_by_user_id')->unsigned()
                ->nullable();
            $table->foreign('created_by_user_id')->references('id')->on('users')
                ->onDelete('set null')
                ->onUpdate('cascade');
            $table->bigInteger('last_updated_by_user_id')->unsigned()
                ->nullable();
            $table->foreign('last_updated_by_user_id')->references('id')->on('users')
                ->onDelete('set null')
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
        Schema::dropIfExists('expenses');
    }
}
