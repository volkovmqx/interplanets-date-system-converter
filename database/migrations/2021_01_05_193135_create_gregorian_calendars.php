<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGregorianCalendars extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gregorian_calendars', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('days')->default(0);
            $table->unsignedInteger('months')->default(0);
            $table->unsignedInteger('years')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gregorian_calendars');
    }
}
