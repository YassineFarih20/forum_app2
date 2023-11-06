<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('remarques', function (Blueprint $table) {
            $table->text('communication')->nullable();
        });
    }

    public function down()
    {
        Schema::table('remarques', function (Blueprint $table) {
            $table->dropColumn('communication');
        });
    }
};
