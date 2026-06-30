<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('exams', function (Blueprint $table) {

            $table->id();

            $table->foreignId('course_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->date('exam_date');

            $table->time('start_time');

            $table->time('end_time');

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exams');
    }
};