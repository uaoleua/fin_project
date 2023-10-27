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
        Schema::create('transactions', function (Blueprint $table) {

            $table->increments('id');
            $table->string('description', 250);
            $table->date('timestamp');
            $table->decimal('amount', $precision = 10, $scale = 2);
            $table->enum('type', ['plus', 'minus']);
            $table->integer('user_id')->unsigned();
            $table->integer('account_id')->unsigned();
            $table->integer('category_id')->nullable()->unsigned();
            $table->integer('income_source_id')->nullable()->unsigned();
            $table->integer('currency_id')->unsigned();

            // Foreign keys
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->cascadeOnDelete()->cascadeOnUpdate();

            $table->foreign('account_id')
                ->references('id')->on('accounts')
                ->cascadeOnDelete()->cascadeOnUpdate();

            $table->foreign('category_id')
                ->references('id')->on('categories')
                ->cascadeOnDelete()->cascadeOnUpdate();

            $table->foreign('income_source_id')
                ->references('id')->on('income_sources')
                ->onDelete('set null')->onUpdate('set null');

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
        Schema::dropIfExists('transactions');
    }
};
