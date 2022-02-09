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
            $table->string('title', 100);
            $table->string('slug', 100);
            $table->integer('status');
            $table->integer('priority');
            $table->integer('destination_id');
            $table->integer('type_id');
            $table->string('photo', 100);
            $table->integer('duration');
            $table->decimal('price', 8, 2);
            $table->text('overview');
            $table->text('include');
            $table->text('depature');
            $table->text('addtional');
            $table->string('map', 200);
            $table->string('video', 200);
            $table->string('image_360', 200);
            $table->string('meta_title', 100);
            $table->string('meta_description', 250);
            $table->timestamps();
            $table->softDeletes();
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