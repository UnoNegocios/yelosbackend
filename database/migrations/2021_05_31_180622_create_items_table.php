<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('sku')->nullable();
            $table->string('macro')->nullable();
            $table->boolean('is_published')->nullable();
            $table->boolean('featured')->nullable();
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();
            $table->date('start_promo')->nullable();
            $table->date('end_promo')->nullable();
            $table->boolean('tax')->nullable();
            $table->string('tax_type')->nullable();
            $table->boolean('buy_when_available')->nullable();
            $table->bigInteger('superiorID')->nullable();

            $table->string('type')->nullable();
            $table->string('cost')->nullable();

            $table->json('inventory')->nullable();
            $table->string('weight')->nullable();
            $table->string('longitude')->nullable();
            $table->string('heihgt')->nullable();
            $table->string('discoiunt_price')->nullable();
            $table->string('price')->nullable();
            $table->string('product_type')->nullable();
            $table->json('categories')->nullable();
            $table->json('images')->nullable();
            //$table->json('variations')->nullable();
            $table->json('ideal_inventory')->nullable();

            $table->bigInteger('created_by_user_id')->unsigned()
                ->nullable();
            $table->foreign('created_by_user_id')->references('id')->on('users')
                ->onDelete('set null')
                ->onUpdate('cascade'); 

            $table->bigInteger('provider_id')->unsigned()
                ->nullable();
            $table->foreign('provider_id')->references('id')->on('providers')
                ->onDelete('set null')
                ->onUpdate('cascade');   

                $table->bigInteger('unit_id')->unsigned()
                ->nullable();
            $table->foreign('unit_id')->references('id')->on('units')
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
        Schema::dropIfExists('items');
    }
}
