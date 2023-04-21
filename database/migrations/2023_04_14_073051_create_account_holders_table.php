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
        Schema::create('account_holders', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');              // unsignedBigInteger
            $table->string('middle_name')->nullable();
            $table->string('contact_number', 10)->unique();     // ->length(10)
            $table->string('email')->unique();
            $table->string('address');
            $table->string('pin_code', 6);                     // ->length(6)
            $table->unsignedBigInteger('state_id');
            $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade');
            $table->string('account_number', 12)->unique();
            $table->integer('amount_balance')->default(0);
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
        Schema::dropIfExists('account_holders');
    }
};
