<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            
            $table->string('name')->unique();
            $table->string('address')->nullable();
            $table->string('delivery_address')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('rfc')->unique()->nullable();
            $table->string('razon_social')->unique()->nullable();
            $table->text('special_note')->nullable();
            $table->string('credit_days')->nullable();
            $table->string('credit_limit')->nullable();
            $table->string('bank_account_number')->nullable();
            $table->text('delivery_time')->nullable();
            
            $table->timestamps();

            $table->bigInteger('phase_id')->unsigned()
                ->nullable();
            $table->foreign('phase_id')->references('id')->on('phases')
                ->onDelete('set null')
                ->onUpdate('cascade');
            $table->bigInteger('origin_id')->unsigned()
                ->nullable();
            $table->foreign('origin_id')->references('id')->on('origins')
                ->onDelete('set null')
                ->onUpdate('cascade');
            $table->bigInteger('user_id')->unsigned()
                ->nullable();
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('set null')
                ->onUpdate('cascade');
            $table->bigInteger('status_id')->unsigned()
                ->nullable();
            $table->foreign('status_id')->references('id')->on('statuses')
                ->onDelete('set null')
                ->onUpdate('cascade');

            /* NEURIK */

            $table->integer('number')->unique()->nullable();// numero de cliente

            $table->text('payment_conditions')->nullable();
            
            $table->text('opportunity_area')->nullable();// area de oportunidad

            $table->json('consumptions')->nullable();// consumos -> productos (por categoria)

            $table->json('special_conditions')->nullable();// condiciones especiales

            $table->bigInteger('cfdi_id')->unsigned()// uso de cfdi
                ->nullable();
            $table->foreign('cfdi_id')->references('id')->on('cfdis')
                ->onDelete('set null')
                ->onUpdate('cascade');
            $table->bigInteger('type_id')->unsigned()// tipo de cliente
                ->nullable();
            $table->foreign('type_id')->references('id')->on('types')
                ->onDelete('set null')
                ->onUpdate('cascade');
            $table->bigInteger('zone_id')->unsigned()// zona
                ->nullable();
            $table->foreign('zone_id')->references('id')->on('zones')
                ->onDelete('set null')
                ->onUpdate('cascade');
            $table->bigInteger('contact_mode_id')->unsigned()// forma en que pasa sus pedidos
                ->nullable();
            $table->foreign('contact_mode_id')->references('id')->on('contact_modes')
                ->onDelete('set null')
                ->onUpdate('cascade');
            $table->bigInteger('payment_method_id')->unsigned()// forma de pago
                ->nullable();
            $table->foreign('payment_method_id')->references('id')->on('payment_methods')
                ->onDelete('set null')
                ->onUpdate('cascade');
            $table->bigInteger('price_list_id')->unsigned()// lista de precios
                ->nullable();
            $table->foreign('price_list_id')->references('id')->on('price_lists')
                ->onDelete('set null')
                ->onUpdate('cascade');
            $table->bigInteger('created_by_user_id')->unsigned()//usuario que creo
                ->nullable();
            $table->foreign('created_by_user_id')->references('id')->on('users')
                ->onDelete('set null')
                ->onUpdate('cascade');
            $table->bigInteger('frequency_id')->unsigned()// frecuencia
                ->nullable();
            $table->foreign('frequency_id')->references('id')->on('frequencies')
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
        Schema::dropIfExists('companies');
    }
}
