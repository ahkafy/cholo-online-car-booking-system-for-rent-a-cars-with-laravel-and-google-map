<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rides', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('owner');
            $table->string('rider');
            
            $table->string('registration')->unique();
            $table->string('registration_expiry_date');
            $table->string('registration_file');

            $table->string('tax_token')->unique();
            $table->string('tax_token_expiry_date');
            $table->string('tac_token_file');

            $table->string('insurance')->unique();
            $table->string('insurance_expiry_date');
            $table->string('insurance_file');

            $table->string('fitness')->unique();
            $table->string('fitness_expiry_date');
            $table->string('fitness_file');

            $table->boolean('is_active')->default(1);

            $table->string('photo');
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
        Schema::dropIfExists('rides');
    }
}
