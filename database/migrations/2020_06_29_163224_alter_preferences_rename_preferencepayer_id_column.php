<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterPreferencesRenamePreferencepayerIdColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('preferences', function (Blueprint $table) {
            $table->renameColumn('preferencepayer_id', 'preference_payer_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('preferences', function (Blueprint $table) {
            $table->renameColumn('preference_payer_id', 'preferencepayer_id');
        });
    }
}
