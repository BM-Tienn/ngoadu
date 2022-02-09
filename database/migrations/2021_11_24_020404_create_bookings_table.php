<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('email', 100);
            $table->string('phone', 20);
            $table->string('address')->nullable();
            $table->string('city', 100)->nullable();
            $table->string('provide', 100)->nullable();
            $table->string('code', 20)->nullable();
            $table->string('country', 100)->nullable();
            $table->text('note')->nullable();
            $table->integer('people');
            $table->integer('price');
            $table->date('start_at');
            $table->integer('tour_id');
            $table->boolean('statuspayment')->nullable()->comment('1: creditCast, 2: Paypal, 3: Payincash');
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
        Schema::dropIfExists('bookings');
    }
}
