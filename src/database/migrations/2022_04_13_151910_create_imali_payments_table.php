<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImaliPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imali_payments', function (Blueprint $table) {
            $table->id();
            $table->integer('store_account_number')->nullable();
            $table->integer('customer_account_number')->nullable();
            $table->double('amount')->default(0);
            $table->string('description')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('status')->nullable()->default('pending');
            $table->string('terminalID')->nullable();
            $table->string('terminalChannel')->nullable();
            $table->string('terminalCompanyName')->nullable();
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
        Schema::dropIfExists('imali_payments');
    }
}
