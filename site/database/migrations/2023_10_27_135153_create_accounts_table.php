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
        Schema::create('accounts', function (Blueprint $table) {

            $table->increments('id');
            $table->string('account_name', 250);
            $table->decimal('balance', $precision = 10, $scale = 2);
            $table->integer('user_id')->unsigned();
            $table->integer('income_sources_id')->unsigned();

            // Foreign Keys
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('income_sources_id')
                ->references('id')->on('income_sources')
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
        Schema::dropIfExists('accounts');
    }
};
