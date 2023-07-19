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
        Schema::create('parking_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_member_id');
            $table->string('car_registration_number');
            $table->dateTime('entry_time');
            $table->dateTime('exit_time')->nullable();
            $table->string('parking_space_number');
            $table->timestamps();

            $table->foreign('student_member_id')->references('id')->on('student_members')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parking_logs');
    }
};
