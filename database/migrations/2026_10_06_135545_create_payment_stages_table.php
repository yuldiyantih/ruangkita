<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payment_stages', function (Blueprint $table) {

            $table->id();

            $table->foreignId('project_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('title');

            $table->decimal(
                'percentage',
                5,
                2
            )->default(0);

            $table->bigInteger('amount')
                ->default(0);

            $table->date('due_date')
                ->nullable();

            $table->enum('status', [
                'pending',
                'awaiting_payment',
                'paid'
            ])->default('pending');

            $table->integer('sort_order')
                ->default(1);

            $table->boolean('is_visible_to_client')
                ->default(true);

            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('payment_stages');
    }
};
