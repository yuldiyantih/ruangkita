<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();

            $table->foreignId('project_id')
                ->constrained('projects')
                ->cascadeOnDelete();

            $table->foreignId('work_id')
                ->nullable()
                ->constrained('works')
                ->nullOnDelete();

            $table->string('title', 150);
            $table->text('description')->nullable();

            $table->date('start_date');
            $table->date('end_date')->nullable();

            $table->enum('status', [
                'planned',
                'ongoing',
                'completed',
                'delayed',
                'cancelled'
            ])->default('planned');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
