<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterPreferencePayersUpdatePhoneAreaCodeColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('preference_payers', function (Blueprint $table) {
            $table->string("phone_area_code")->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('preference_payers', function (Blueprint $table) {
            $table->string("phone_area_code")->nullable(false)->change();
        });
    }
}
