<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ar_design_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('ar_design_id')
                ->constrained('ar_designs')
                ->cascadeOnDelete();

            $table->foreignId('ar_asset_id')
                ->constrained('ar_assets')
                ->restrictOnDelete();

            $table->decimal('position_x', 10, 4)
                ->default(0);

            $table->decimal('position_y', 10, 4)
                ->default(0);

            $table->decimal('position_z', 10, 4)
                ->default(0);

            $table->decimal('rotation_x', 10, 4)
                ->default(0);

            $table->decimal('rotation_y', 10, 4)
                ->default(0);

            $table->decimal('rotation_z', 10, 4)
                ->default(0);

            $table->decimal('scale_x', 10, 4)
                ->default(1);

            $table->decimal('scale_y', 10, 4)
                ->default(1);

            $table->decimal('scale_z', 10, 4)
                ->default(1);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ar_design_items');
    }
};
