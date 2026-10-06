<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('documentations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('project_id')
                ->constrained('projects')
                ->cascadeOnDelete();

            $table->foreignId('uploaded_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->enum('category', [
                'before',
                'during',
                'after'
            ]);

            $table->string('title', 150)
                ->nullable();

            $table->text('description')
                ->nullable();

            $table->string('file_path');

            $table->date('photo_date')
                ->nullable();

            $table->boolean('is_visible_to_client')
                ->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('documentations');
    }
};
