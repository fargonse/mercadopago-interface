<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreferenceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preference_items', function (Blueprint $table) {
            $table->id();
            $table->integer('preference_id');
            $table->string('custom_id');
            $table->string('title');
            $table->string('currency_id')->default('ARS');
            $table->string('picture_url')->nullable();
            $table->string('description');
            $table->string('category_id')->nullable();
            $table->integer('quantity')->defaut(1);
            $table->float('unit_price');
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
        Schema::dropIfExists('preference_items');
    }
}
