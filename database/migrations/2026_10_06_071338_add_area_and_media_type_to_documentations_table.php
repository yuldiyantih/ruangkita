<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('documentations', function (Blueprint $table) {

            $table->foreignId('project_area_id')
                ->nullable()
                ->after('project_id')
                ->constrained('project_areas')
                ->nullOnDelete();

            $table->enum(
                'media_type',
                [
                    'photo',
                    'video',
                    'document'
                ]
            )
                ->default('photo')
                ->after('category');
        });
    }

    public function down(): void
    {
        Schema::table('documentations', function (Blueprint $table) {

            $table->dropForeign([
                'project_area_id'
            ]);

            $table->dropColumn([
                'project_area_id',
                'media_type'
            ]);
        });
    }
};
