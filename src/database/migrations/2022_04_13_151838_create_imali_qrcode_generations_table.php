<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImaliQrcodeGenerationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imali_qrcode_generations', function (Blueprint $table) {
            $table->id();
            $table->string('transaction')->nullable();
            $table->double('amount')->default(0);
            $table->integer('account_number')->nullable();
            $table->string('status')->default('pendente')->nullable();
            $table->string('address_store')->nullable();
            $table->string('institution')->nullable();
            $table->string('promo')->nullable();
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
        Schema::dropIfExists('imali_qrcode_generations');
    }
}
