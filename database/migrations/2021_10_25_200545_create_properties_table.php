<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('title');
            $table->text('desc');
            $table->integer('quantity');
            $table->string('image', 200 );
            $table->double('original_price');
            $table->double('discount_price');
            $table->integer('sqft')->unsigned();
            $table->integer('bed')->unsigned();
            $table->integer('bath')->unsigned();
            $table->integer('adults');
            $table->integer('children');
            $table->tinyInteger('featured')->default( 0 );
            $table->string('latitude');
            $table->string('longitude');
            $table->string('area');
            $table->string('city_id');
            $table->string('country_id');
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
        Schema::dropIfExists('properties');
    }
}
