<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('campus_locations', function (Blueprint $table) {
            $table->id();
            $table->string('building_name');
            $table->string('floor')->nullable();
            $table->string('room_number')->nullable();
            $table->text('description')->nullable();
            $table->string('location_image')->nullable(); // gambar lokasi (opsional)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('campus_locations');
    }
};