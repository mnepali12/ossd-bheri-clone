<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('file_path');
            $table->string('file_type');
            $table->bigInteger('file_size');
            $table->string('category');
            $table->foreignId('uploaded_by')->constrained('users')->onDelete('cascade');
            $table->boolean('is_published')->default(true);
            $table->integer('download_count')->default(0);
            $table->timestamps();
            $table->index('category');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
