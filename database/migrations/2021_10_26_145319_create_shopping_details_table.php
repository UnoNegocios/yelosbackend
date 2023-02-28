<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShoppingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shopping_details', function (Blueprint $table) {
            $table->id();
            $table->double('quantity')->nullable();
            $table->integer('merma')->nullable()->default('0');
            $table->json('productionsID')->nullable();
            $table->json('salesID')->nullable();
            $table->double('unit_cost')->nullable();
            $table->string('used')->nullable()->default('0');

            $table->bigInteger('shopping_id')->unsigned()->nullable();
            $table->bigInteger('item_id')->unsigned()->nullable();
            $table->bigInteger('created_by_user_id')->unsigned()->nullable();
            $table->bigInteger('last_updated_by_user_id')->unsigned()->nullable();
            


            $table->foreign('shopping_id')->references('id')->on('shoppings')
                ->onDelete('set null')
                ->onUpdate('cascade');
            $table->foreign('item_id')->references('id')->on('items')
                ->onDelete('set null')
                ->onUpdate('cascade');
            $table->foreign('created_by_user_id')->references('id')->on('users')
                ->onDelete('set null')
                ->onUpdate('cascade');
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
        Schema::dropIfExists('shopping_details');
    }
}
