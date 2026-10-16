<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('messages', function (Blueprint $table) {

            if (!Schema::hasColumn('messages', 'attachment_path')) {
                $table->string('attachment_path')
                    ->nullable()
                    ->after('message_text');
            }

            if (!Schema::hasColumn('messages', 'attachment_name')) {
                $table->string('attachment_name')
                    ->nullable()
                    ->after('attachment_path');
            }

            if (!Schema::hasColumn('messages', 'attachment_type')) {
                $table->string('attachment_type')
                    ->nullable()
                    ->after('attachment_name');
            }

            if (!Schema::hasColumn('messages', 'attachment_size')) {
                $table->unsignedBigInteger('attachment_size')
                    ->nullable()
                    ->after('attachment_type');
            }
        });
    }


    public function down(): void
    {
        Schema::table('messages', function (Blueprint $table) {

            $columns = [];

            if (Schema::hasColumn('messages', 'attachment_name')) {
                $columns[] = 'attachment_name';
            }

            if (Schema::hasColumn('messages', 'attachment_type')) {
                $columns[] = 'attachment_type';
            }

            if (Schema::hasColumn('messages', 'attachment_size')) {
                $columns[] = 'attachment_size';
            }

            if (!empty($columns)) {
                $table->dropColumn($columns);
            }
        });
    }
};
