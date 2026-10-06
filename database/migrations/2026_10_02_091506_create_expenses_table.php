<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();

            $table->foreignId('project_id')
                ->constrained('projects')
                ->cascadeOnDelete();

            $table->foreignId('material_id')
                ->nullable()
                ->constrained('materials')
                ->nullOnDelete();

            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->date('expense_date');

            $table->string('store_name', 150)
                ->nullable();

            $table->enum('category', [
                'material',
                'labor',
                'transport',
                'equipment',
                'other'
            ]);

            $table->text('description')
                ->nullable();

            $table->decimal('amount', 15, 2)
                ->default(0);

            $table->enum('funding_source', [
                'project',
                'personal'
            ])->default('project');

            $table->string('receipt_path')
                ->nullable();

            $table->boolean('is_visible_to_client')
                ->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
