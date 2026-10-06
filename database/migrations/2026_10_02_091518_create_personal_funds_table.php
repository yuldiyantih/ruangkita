<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('personal_funds', function (Blueprint $table) {
            $table->id();

            $table->foreignId('expense_id')
                ->unique()
                ->constrained('expenses')
                ->cascadeOnDelete();

            $table->foreignId('user_id')
                ->constrained('users')
                ->restrictOnDelete();

            $table->decimal('amount', 15, 2);

            $table->enum('reimbursement_status', [
                'unpaid',
                'paid'
            ])->default('unpaid');

            $table->date('reimbursement_date')
                ->nullable();

            $table->text('notes')
                ->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('personal_funds');
    }
};
