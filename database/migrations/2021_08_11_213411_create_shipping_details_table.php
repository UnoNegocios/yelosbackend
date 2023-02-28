<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping_details', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('sale_id')->unsigned()->nullable();
            $table->foreign('sale_id')->references('id')->on('quotations')
                ->onDelete('set null')
                ->onUpdate('cascade');
            $table->bigInteger('shipping_id')->unsigned()->nullable();
            $table->foreign('shipping_id')->references('id')->on('shippings')
                ->onDelete('set null')
                ->onUpdate('cascade');
            
            $table->boolean('completed')->nullable();
            $table->string('invoice')->nullable();
            $table->string('pdf')->nullable();

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
        Schema::dropIfExists('shipping_details');
    }
}
