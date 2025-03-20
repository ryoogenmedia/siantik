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
        Schema::create('institutions', function (Blueprint $table) {
            $table->id();
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
            $table->string('name')->nullable();
            $table->text('address')->nullable();
            $table->time('time_check_in_start')->nullable();
            $table->time('time_check_in_end')->nullable();
            $table->time('time_check_out_start')->nullable();
            $table->time('time_check_out_end')->nullable();
            $table->string('logo')->nullable();
            $table->string('radius')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('institutions');
    }
};
