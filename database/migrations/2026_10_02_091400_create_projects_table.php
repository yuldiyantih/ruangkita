<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();

            $table->foreignId('client_id')
                ->constrained('clients')
                ->restrictOnDelete();

            $table->foreignId('admin_id')
                ->constrained('users')
                ->restrictOnDelete();

            $table->string('project_name', 150);
            $table->text('description')->nullable();
            $table->string('location');

            $table->date('start_date')->nullable();
            $table->date('target_end_date')->nullable();

            $table->enum('status', [
                'planning',
                'ongoing',
                'paused',
                'completed',
                'cancelled'
            ])->default('planning');

            $table->unsignedTinyInteger('progress_percentage')
                ->default(0);

            $table->decimal('budget_total', 15, 2)
                ->default(0);

            $table->string('cover_image')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
