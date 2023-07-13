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
        Schema::create('member_cars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_member_id');
            $table->foreign('student_member_id')->references('id')->on('student_members');
            $table->string('registration_number');
            $table->string('make');
            $table->string('model');
            $table->string('color');
            $table->date('registration_date');
            $table->enum('status', ['approved', 'pending', 'declined'])->default('pending');
            $table->date('expiry_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member_cars');
    }
};
