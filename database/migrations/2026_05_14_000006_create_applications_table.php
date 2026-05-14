<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->string('reference_number')->unique();
            $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
            $table->string('form_type');
            $table->json('form_data')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected', 'submitted'])->default('pending');
            $table->timestamp('submitted_at');
            $table->foreignId('reviewed_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('reviewed_at')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();
            $table->index('status');
            $table->index('student_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
