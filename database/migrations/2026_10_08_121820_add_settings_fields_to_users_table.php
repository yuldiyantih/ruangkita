<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('notify_messages')
                ->default(true);

            $table->boolean('notify_progress')
                ->default(true);

            $table->boolean('notify_schedule')
                ->default(true);

            $table->boolean('notify_documentation')
                ->default(true);

            $table->boolean('notify_cost')
                ->default(true);

            $table->string('language', 10)
                ->default('id');

            $table->string('timezone', 50)
                ->default('Asia/Jakarta');

            $table->string('theme', 20)
                ->default('light');
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'notify_messages',
                'notify_progress',
                'notify_schedule',
                'notify_documentation',
                'notify_cost',
                'language',
                'timezone',
                'theme',
            ]);
        });
    }
};
