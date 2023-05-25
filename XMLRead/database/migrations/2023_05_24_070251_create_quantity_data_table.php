<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuantityDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quantity_data', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->nullable();
            $table->string('rfc')->nullable();
            $table->decimal('cantidad_total',10,2)->nullable();
            $table->decimal('monto_total',10,2)->nullable();
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
        Schema::dropIfExists('quantity_data');
    }
}
