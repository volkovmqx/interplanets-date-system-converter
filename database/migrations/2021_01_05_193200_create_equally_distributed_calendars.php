<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquallyDistributedCalendars extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equally_distributed_calendars', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('days')->default(0);
            $table->unsignedInteger('months')->default(0);
            $table->unsignedInteger('years')->default(0);
            $table->unsignedInteger('days_per_month');
            $table->unsignedInteger('months_per_year');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('equally_distributed_calendars');
    }
}
