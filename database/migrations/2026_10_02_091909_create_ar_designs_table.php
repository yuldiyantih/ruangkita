<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ar_designs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('project_id')
                ->constrained('projects')
                ->cascadeOnDelete();

            $table->foreignId('project_area_id')
                ->constrained('project_areas')
                ->cascadeOnDelete();

            $table->foreignId('client_id')
                ->constrained('clients')
                ->cascadeOnDelete();

            $table->string('design_name', 150);

            $table->string('preview_image')
                ->nullable();

            $table->text('notes')
                ->nullable();

            $table->enum('status', [
                'draft',
                'submitted',
                'approved',
                'rejected'
            ])->default('draft');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ar_designs');
    }
};
