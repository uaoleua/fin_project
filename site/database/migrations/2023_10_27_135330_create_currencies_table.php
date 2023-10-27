<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('currency_name', ['гривня', 'долар', 'євро'])->default('гривня');
            $table->enum('symbol', ['&#8372;', '$', '€'])->default('&#8372;');
            $table->enum('code', ['UAH', 'USD', 'EUR'])->default('UAH');
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
        Schema::dropIfExists('currencies');
    }
};
