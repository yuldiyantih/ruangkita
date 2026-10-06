<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ar_assets', function (Blueprint $table) {
            $table->id();

            $table->string('name', 150);

            $table->enum('asset_type', [
                'color',
                'material',
                'furniture'
            ]);

            $table->string('category', 100)
                ->nullable();

            $table->string('color_code', 20)
                ->nullable();

            $table->string('texture_path')
                ->nullable();

            $table->string('model_3d_path')
                ->nullable();

            $table->string('thumbnail_path')
                ->nullable();

            $table->boolean('is_active')
                ->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ar_assets');
    }
};
