<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotations', function (Blueprint $table) {
            $table->id();


            $table->bigInteger('company_id')->unsigned()->nullable();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->string('pdf')->nullable();
            $table->text('note')->nullable();
            $table->string('status')->nullable()->default('quotation');
            $table->json('items');
            $table->bigInteger('contact_id')->unsigned()->nullable();
            $table->bigInteger('rejection_id')->unsigned()->nullable();
            $table->text('rejection_comment')->nullable();
            $table->timestamps();
            $table->foreign('contact_id')->references('id')->on('contacts')
                ->onDelete('set null')
                ->onUpdate('cascade');
            $table->foreign('rejection_id')->references('id')->on('rejections')
                ->onDelete('set null')
                ->onUpdate('cascade');
            $table->foreign('company_id')->references('id')->on('companies')
                ->onDelete('set null')
                ->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('set null')
                ->onUpdate('cascade');


            $table->boolean('bar')->nullable();
            $table->date('date')->nullable();
            $table->string('type')->nullable();
            $table->double('subtotal');
            $table->double('iva');
            $table->double('total');
            $table->string('invoice')->nullable();
            $table->boolean('printed')->nullable();
            $table->boolean('production_dispatched')->nullable();
            $table->string('invoice_date')->nullable();
            $table->date('due_date')->nullable();
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
        Schema::dropIfExists('quotations');
    }
}
