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
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('account_id');
            $table->unsignedInteger('category_id')->nullable();
            $table->unsignedInteger('income_source_id')->nullable();
            $table->unsignedInteger('currency_id');

            // Foreign keys
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('account_id')
                ->references('id')->on('accounts')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('category_id')
                ->references('id')->on('categories')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('income_source_id')
                ->references('id')->on('income_sources')
                ->onDelete('set null')->onUpdate('set null');

            $table->foreign('currency_id')
                ->references('id')->on('currencies')
                ->onDelete('cascade')->onUpdate('cascade');

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
