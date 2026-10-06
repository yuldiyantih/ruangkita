<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->id();

            $table->foreignId('project_id')
                ->constrained('projects')
                ->cascadeOnDelete();

            $table->string('material_name', 150);

            $table->decimal('quantity', 12, 2)
                ->default(0);

            $table->string('unit', 30)
                ->nullable();

            $table->decimal('unit_price', 15, 2)
                ->default(0);

            $table->decimal('total_price', 15, 2)
                ->default(0);

            $table->string('supplier', 150)
                ->nullable();

            $table->date('purchase_date')
                ->nullable();

            $table->boolean('is_visible_to_client')
                ->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
};
