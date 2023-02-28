<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('production_details', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('production_id')->unsigned()
                ->nullable();
            $table->foreign('production_id')->references('id')->on('productions')
                ->onDelete('set null')
                ->onUpdate('cascade');

            $table->bigInteger('item_id')->unsigned()
                ->nullable();
            $table->foreign('item_id')->references('id')->on('items')
                ->onDelete('set null')
                ->onUpdate('cascade');
                
            $table->double('quantity')->nullable();
            $table->json('insumos')->nullable();
            $table->json('salesID')->nullable();

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
        Schema::dropIfExists('production_details');
    }
}
