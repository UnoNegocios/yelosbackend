<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('from_user_id')->unsigned()
            ->nullable();
        $table->bigInteger('to_user_id')->unsigned()
            ->nullable();
        $table->bigInteger('company_id')->unsigned()
            ->nullable();
        $table->bigInteger('contact_id')->unsigned()
            ->nullable();

        $table->text('comment')->nullable();
        $table->boolean('seen')->nullabe()->default(0);

        $table->foreign('from_user_id')->references('id')->on('users')
            ->onDelete('set null')
            ->onUpdate('cascade');
        $table->foreign('to_user_id')->references('id')->on('users')
            ->onDelete('set null')
            ->onUpdate('cascade');
        $table->foreign('company_id')->references('id')->on('companies')
            ->onDelete('set null')
            ->onUpdate('cascade');
        $table->foreign('contact_id')->references('id')->on('contacts')
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
        Schema::dropIfExists('notes');
    }
}
