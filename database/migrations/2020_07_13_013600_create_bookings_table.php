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
            $table->string('user_id');
            $table->string('ride_type');
            $table->string('from');
            $table->string('to');
            $table->string('pickup_date');
            $table->string('pickup_time');
            $table->string('payment_method');
            $table->string('distance');
            $table->string('fair_amount');
            $table->string('waiting');
            $table->string('remarks')->nullable();
            $table->string('status');
            $table->string('ride_id')->nullable();
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
