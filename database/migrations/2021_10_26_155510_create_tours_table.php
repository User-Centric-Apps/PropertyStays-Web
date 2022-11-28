<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateToursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tours', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('code', 50);
            $table->string('title', 200);
            $table->string('image', 200 );
            $table->string('video', 200);
            $table->text('desc');
            $table->text('tour_included');
            $table->text('tour_excluded');
            $table->text('tour_highlight');
            $table->string('latitude', 100);
            $table->string('longitude', 100);
            $table->string('area', 200);
            $table->integer('city_id');
            $table->integer('country_id');
            $table->double('adult_price');
            $table->double('child_price');
            $table->double('infant_price');
            $table->string('tour_type', 10)->comment('daily/fixed');
            $table->tinyInteger('featured')->default( 0 );
            $table->tinyInteger('cancellation')->default( 0 );
            $table->tinyInteger('status')->default( 0 );
            $table->string('slug', 250);
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
        Schema::dropIfExists('tours');
    }
}
