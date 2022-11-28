<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateToursBookingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tours_booking', function (Blueprint $table) {
            $table->id();
            $table->integer('tour_id');
            $table->string('name', 100);
            $table->string('email', 100);
            $table->string('mobile', 20);
            $table->string('desc', 250);
            $table->tinyInteger('approved')->default( 0 );
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
        Schema::dropIfExists('tours_booking');
    }
}
