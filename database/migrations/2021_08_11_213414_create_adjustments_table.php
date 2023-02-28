<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdjustmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adjustments', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('item_id')->unsigned()
                ->nullable();
            $table->foreign('item_id')->references('id')->on('items')
                ->onDelete('set null')
                ->onUpdate('cascade');
                
            $table->date('date')->nullable();
            $table->double('amount')->nullable();
            $table->text('note')->nullable();

            $table->bigInteger('created_by_user_id')->unsigned()
                ->nullable();
            $table->foreign('created_by_user_id')->references('id')->on('users')
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
        Schema::dropIfExists('adjustments');
    }
}
