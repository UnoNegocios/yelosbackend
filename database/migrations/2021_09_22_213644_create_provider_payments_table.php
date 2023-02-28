<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProviderPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provider_payments', function (Blueprint $table) {
            $table->id();
            $table->json('shoppingsID')->nullable();
            $table->string('date')->nullable();
            $table->string('amount')->nullable();
            $table->string('payment_method')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();

            $table->bigInteger('provider_id')->unsigned()
            ->nullable();
            $table->foreign('provider_id')->references('id')->on('providers')
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
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('provider_payments');
    }
}
