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
            $table->id();
            $table->string('account_number');
            $table->foreign('account_number')->references('account_number')->on('account_holders')->onDelete('cascade');
            $table->date('date');
            $table->unsignedBigInteger('amount');
            $table->tinyInteger('transaction_type')->comment('1: Deposit, 2: Withdraw');
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
