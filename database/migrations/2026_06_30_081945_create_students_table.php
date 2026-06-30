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
        Schema::create('students', function (Blueprint $table) {

            $table->id();

            $table->string('student_id')->unique();

            $table->string('student_name');

            $table->foreignId('department_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->foreignId('course_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->integer('semester');

            $table->string('section');

            $table->integer('batch');

            $table->string('email')->nullable();

            $table->string('phone')->nullable();

            $table->enum('status', [
                'Active',
                'Inactive'
            ])->default('Active');

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};