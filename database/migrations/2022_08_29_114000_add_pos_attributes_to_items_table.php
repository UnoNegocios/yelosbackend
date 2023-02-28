<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPosAttributesToItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('items', function (Blueprint $table) {
            
            $table->string('code_one')->nullable();
            $table->string('code_two')->nullable();
            $table->string('code_three')->nullable();
            $table->string('price_one')->nullable();
            $table->string('price_two')->nullable();
            $table->string('price_three')->nullable();
            $table->string('price_four')->nullable();
            $table->string('sat_key_code')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->dropColumn('code_one');
            $table->dropColumn('code_two');
            $table->dropColumn('code_three');
            $table->dropColumn('price_one');
            $table->dropColumn('price_two');
            $table->dropColumn('price_three');
            $table->dropColumn('price_four');
            $table->dropColumn('sat_key_code');
        });
    }
}
