<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreferencePaymentMethodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preference_payment_methods', function (Blueprint $table) {
            $table->id();
            $table->integer('preference_id');
            $table->json('excluded_payment_methods')->nullable();
            $table->json('excluded_payment_types')->nullable();
            $table->integer('installments')->default(1);
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
        Schema::dropIfExists('preference_payment_methods');
    }
}
