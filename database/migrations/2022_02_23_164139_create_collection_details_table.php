<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollectionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collection_details', function (Blueprint $table) {
            $table->id();
            $table->double('amount');
            $table->double('due');
            $table->double('new_due');

            $table->bigInteger('collection_id')->unsigned()->nullable();
            $table->bigInteger('sale_id')->unsigned()->nullable();

            $table->foreign('collection_id')->references('id')->on('collections')
                ->onDelete('set null')
                ->onUpdate('cascade');
            $table->foreign('sale_id')->references('id')->on('quotations')
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
        Schema::dropIfExists('collection_details');
    }
}
