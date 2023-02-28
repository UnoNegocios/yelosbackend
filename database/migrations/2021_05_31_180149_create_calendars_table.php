<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalendarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendars', function (Blueprint $table) {
            $table->id();

            $table->datetime('date')->nullable();
            $table->date('only_date')->nullable();
            $table->time('only_time')->nullable();
            $table->text('description')->nullable();    
            $table->boolean('completed')->nullable()->default(false);

            $table->timestamps();

            $table->bigInteger('company_id')->unsigned()
            ->nullable();
        $table->bigInteger('contact_id')->unsigned()
            ->nullable();
        $table->bigInteger('activity_id')->unsigned()
            ->nullable();
        $table->bigInteger('user_id')->unsigned()
            ->nullable();

            $table->foreign('contact_id')->references('id')->on('contacts')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        $table->foreign('activity_id')->references('id')->on('activities')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        $table->foreign('company_id')->references('id')->on('companies')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        $table->foreign('user_id')->references('id')->on('users')
            ->onDelete('set null')
            ->onUpdate('cascade');


            $table->text('result')->nullable(); 
            //'abrir venta',
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
        Schema::dropIfExists('calendars');
    }
}
