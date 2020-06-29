<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preferences', function (Blueprint $table) {
            $table->id();
            $table->integer('client_id');
            $table->integer('payer_id');
            $table->string('auto_return', 15)->nullable();
            $table->string('notification_url', 250)->nullable();
            $table->string('external_reference', 250);
            $table->boolean('expires')->deafult(0);
            $table->datetime('expiration_date_from')->nullable();
            $table->datetime('expiration_date_to')->nullable();
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
        Schema::dropIfExists('preferences');
    }
}
