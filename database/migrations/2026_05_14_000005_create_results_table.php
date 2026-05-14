<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
            $table->string('subject');
            $table->integer('marks_obtained');
            $table->integer('total_marks');
            $table->float('percentage');
            $table->string('grade');
            $table->text('remarks')->nullable();
            $table->date('exam_date');
            $table->timestamps();
            $table->index('student_id');
            $table->index('exam_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('results');
    }
};
