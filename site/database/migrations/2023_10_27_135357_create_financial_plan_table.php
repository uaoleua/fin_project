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
        Schema::create('financial_plan', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('amount', $precision = 10, $scale = 2);
            $table->date('date');
            $table->integer('user_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->integer('currency_id')->unsigned();

            // Foreign Keys
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->cascadeOnDelete()->cascadeOnUpdate();

            $table->foreign('category_id')
                ->references('id')->on('categories')
                ->cascadeOnDelete()->cascadeOnUpdate();

            $table->foreign('currency_id')
                ->references('id')->on('currencies')
                ->cascadeOnDelete()->cascadeOnUpdate();

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
        Schema::dropIfExists('financial_plan');
    }
};
