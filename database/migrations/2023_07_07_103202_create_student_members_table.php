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
        Schema::create('student_members', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('student_id', 20);
            $table->date('expiry_date')->nullable();
            $table->string('national_id', 20)->nullable();
            $table->string('passport_no', 20)->nullable();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('email')->unique();
            $table->enum('disabled', ['Yes', 'No'])->default('No')->nullable();
            $table->string('mobile', 15)->nullable();
            $table->string('address')->nullable();
            $table->string('course_faculty', 50)->nullable();
            $table->enum('mode_of_study', ['Day', 'Evening'])->nullable();
            $table->enum('status', ['approved', 'declined', 'pending'])->default('pending');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_members');
    }
};
