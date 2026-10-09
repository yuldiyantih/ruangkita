<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {

            $table->id();

            $table->foreignId('project_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('payment_stage_id')
                ->nullable()
                ->constrained('payment_stages')
                ->nullOnDelete();

            $table->bigInteger('amount');

            $table->date('payment_date')
                ->nullable();

            $table->string('reference_number')
                ->nullable();

            $table->string('proof_file')
                ->nullable();

            $table->enum('status', [
                'pending',
                'verified',
                'rejected'
            ])->default('pending');

            $table->text('note')
                ->nullable();

            $table->boolean('is_visible_to_client')
                ->default(true);

            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
