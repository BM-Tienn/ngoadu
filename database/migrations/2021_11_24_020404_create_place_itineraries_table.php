<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlaceItinerariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('place_itineraries', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('itinerary_id')->index('itinerary_id');
            $table->string('location', 100);
            $table->integer('duration')->nullable();
            $table->text('description');
            $table->string('note', 100)->nullable();
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
        Schema::dropIfExists('place_itineraries');
    }
}
