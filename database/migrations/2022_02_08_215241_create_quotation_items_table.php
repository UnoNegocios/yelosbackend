<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotationItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotation_items', function (Blueprint $table) {
            $table->id();

            $table->double('quantity');

            $table->double('value');
            $table->double('price');
            $table->double('cost');


            $table->bigInteger('quotation_id')->unsigned()
            ->nullable();
            $table->foreign('quotation_id')->references('id')->on('quotations')
                ->onDelete('set null')
                ->onUpdate('cascade');

                $table->bigInteger('item_id')->unsigned()
                ->nullable();
                $table->foreign('item_id')->references('id')->on('items')
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
        Schema::dropIfExists('quotation_items');
    }
}
