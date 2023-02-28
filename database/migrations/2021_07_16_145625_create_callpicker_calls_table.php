<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCallpickerCallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('callpicker_calls', function (Blueprint $table) {
            $table->id();
            
            $table->string('request_id')->nullable();
            $table->string('call_type')->nullable();
            $table->string('call_status')->nullable();
            $table->datetime('date')->nullable();
            $table->string('caller_id')->nullable();
            $table->string('duration')->nullable();
            $table->string('callpicker_number')->nullable();
            $table->string('dialed_number')->nullable();
            $table->string('answered_by')->nullable();
            $table->string('dialed_by')->nullable();
            $table->string('records')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('record_keys')->nullable();
            $table->string('note')->nullable();

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
        Schema::dropIfExists('callpicker_calls');
    }
}
