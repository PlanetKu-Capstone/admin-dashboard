<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('carbons', function (Blueprint $table) {
            $table->id();
            $table->float('electriccity');
            $table->float('gas');
            $table->float('transportation');
            $table->float('food');
            $table->float('organic_waste');
            $table->float('inorganic_waste');
            $table->float('carbon_footprint');
            $table->foreignId('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carbons');
    }
};
