<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayrollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payrolls', function (Blueprint $table) {
            $table->id();
            $table->string('date')->nullable();
            $table->double('imss')->nullable();
            $table->double('infonavit')->nullable();
            $table->double('amount')->nullable();
            $table->double('extra_time')->nullable();
            $table->double('concept')->nullable();
            $table->double('production_award')->nullable();
            $table->double('punctuality_award')->nullable();
            $table->double('performance_award')->nullable();
            $table->double('absence')->nullable();
            $table->text('notes')->nullable();

            $table->bigInteger('user_id')->unsigned()
            ->nullable();
            $table->foreign('user_id')->references('id')->on('users')
            ->onDelete('set null')
            ->onUpdate('cascade');

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
        Schema::dropIfExists('payrolls');
    }
}
