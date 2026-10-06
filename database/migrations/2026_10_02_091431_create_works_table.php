<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('works', function (Blueprint $table) {
            $table->id();

            $table->foreignId('project_id')
                ->constrained('projects')
                ->cascadeOnDelete();

            $table->string('work_name', 150);

            $table->enum('method_type', [
                'daily',
                'contract'
            ]);

            $table->decimal('volume', 12, 2)->nullable();
            $table->string('unit', 50)->nullable();

            $table->decimal('unit_price', 15, 2)->default(0);
            $table->unsignedInteger('duration_days')->nullable();

            $table->decimal('total_cost', 15, 2)->default(0);

            $table->enum('status', [
                'planned',
                'ongoing',
                'completed',
                'cancelled'
            ])->default('planned');

            $table->boolean('is_visible_to_client')
                ->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('works');
    }
};
