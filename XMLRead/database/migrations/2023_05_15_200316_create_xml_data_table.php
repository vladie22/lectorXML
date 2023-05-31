<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateXmlDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('xml_data', function (Blueprint $table) {
            $table->id();
            $table->string('fecha')->nullable();
            $table->string('rfc')->nullable();
            $table->string('nombre')->nullable();
            $table->string('folio')->nullable();
            $table->text('uuid')->nullable();
            $table->decimal('cantidad',10,2)->nullable();
            $table->decimal('total',10,2)->nullable();
            $table->decimal('precioUnitario',10,2)->nullable();
            $table->string('claveProdServ')->nullable();
            $table->string('estado')->nullable();
            $table->string('folioAlfa')->nullable();
            $table->string('arribo')->nullable();
            $table->string('arribo2')->nullable();

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
        Schema::dropIfExists('xml_data');
    }
}
