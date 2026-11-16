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
        /*
        |--------------------------------------------------------------------------
        | USERS
        |--------------------------------------------------------------------------
        */
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('id', 'user_id');
            $table->renameColumn('name', 'user_name');
        });

        /*
        |--------------------------------------------------------------------------
        | CLIENTS
        |--------------------------------------------------------------------------
        */
        Schema::table('clients', function (Blueprint $table) {
            $table->renameColumn('id', 'client_id');
        });

        /*
        |--------------------------------------------------------------------------
        | PROJECTS
        |--------------------------------------------------------------------------
        */
        Schema::table('projects', function (Blueprint $table) {
            $table->renameColumn('id', 'project_id');
            $table->renameColumn('status', 'project_status');
        });

        /*
        |--------------------------------------------------------------------------
        | PROJECT AREAS
        |--------------------------------------------------------------------------
        */
        Schema::table('project_areas', function (Blueprint $table) {
            $table->renameColumn('id', 'project_area_id');
        });

        /*
        |--------------------------------------------------------------------------
        | WORKS
        |--------------------------------------------------------------------------
        */
        Schema::table('works', function (Blueprint $table) {
            $table->renameColumn('id', 'work_id');
            $table->renameColumn('status', 'work_status');
        });

        /*
        |--------------------------------------------------------------------------
        | SCHEDULES
        |--------------------------------------------------------------------------
        */
        Schema::table('schedules', function (Blueprint $table) {
            $table->renameColumn('id', 'schedule_id');
            $table->renameColumn('status', 'schedule_status');
        });

        /*
        |--------------------------------------------------------------------------
        | MATERIALS
        |--------------------------------------------------------------------------
        */
        Schema::table('materials', function (Blueprint $table) {
            $table->renameColumn('id', 'material_id');
        });

        /*
        |--------------------------------------------------------------------------
        | EXPENSES
        |--------------------------------------------------------------------------
        */
        Schema::table('expenses', function (Blueprint $table) {
            $table->renameColumn('id', 'expense_id');
        });

        /*
        |--------------------------------------------------------------------------
        | PERSONAL FUNDS
        |--------------------------------------------------------------------------
        */
        Schema::table('personal_funds', function (Blueprint $table) {
            $table->renameColumn('id', 'personal_fund_id');
        });

        /*
        |--------------------------------------------------------------------------
        | PROGRESS UPDATES
        |--------------------------------------------------------------------------
        */
        Schema::table('progress_updates', function (Blueprint $table) {
            $table->renameColumn('id', 'progress_update_id');
        });

        /*
        |--------------------------------------------------------------------------
        | DOCUMENTATIONS
        |--------------------------------------------------------------------------
        */
        Schema::table('documentations', function (Blueprint $table) {
            $table->renameColumn('id', 'documentation_id');
        });

        /*
        |--------------------------------------------------------------------------
        | MESSAGES
        |--------------------------------------------------------------------------
        */
        Schema::table('messages', function (Blueprint $table) {
            $table->renameColumn('id', 'message_id');
        });

        /*
        |--------------------------------------------------------------------------
        | NOTIFICATIONS
        |--------------------------------------------------------------------------
        */
        Schema::table('notifications', function (Blueprint $table) {
            $table->renameColumn('id', 'notification_id');
        });

        /*
        |--------------------------------------------------------------------------
        | PAYMENT STAGES
        |--------------------------------------------------------------------------
        */
        Schema::table('payment_stages', function (Blueprint $table) {
            $table->renameColumn('id', 'payment_stage_id');
            $table->renameColumn('status', 'payment_stage_status');
        });

        /*
        |--------------------------------------------------------------------------
        | PAYMENTS
        |--------------------------------------------------------------------------
        */
        Schema::table('payments', function (Blueprint $table) {
            $table->renameColumn('id', 'payment_id');
            $table->renameColumn('status', 'payment_status');
        });

        /*
        |--------------------------------------------------------------------------
        | AR ASSETS
        |--------------------------------------------------------------------------
        */
        Schema::table('ar_assets', function (Blueprint $table) {
            $table->renameColumn('id', 'ar_asset_id');
            $table->renameColumn('name', 'ar_asset_name');
        });

        /*
        |--------------------------------------------------------------------------
        | AR DESIGNS
        |--------------------------------------------------------------------------
        */
        Schema::table('ar_designs', function (Blueprint $table) {
            $table->renameColumn('id', 'ar_design_id');
            $table->renameColumn('status', 'ar_design_status');
        });

        /*
        |--------------------------------------------------------------------------
        | AR DESIGN ITEMS
        |--------------------------------------------------------------------------
        */
        Schema::table('ar_design_items', function (Blueprint $table) {
            $table->renameColumn('id', 'ar_design_item_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        /*
        |--------------------------------------------------------------------------
        | AR DESIGN ITEMS
        |--------------------------------------------------------------------------
        */
        Schema::table('ar_design_items', function (Blueprint $table) {
            $table->renameColumn('ar_design_item_id', 'id');
        });

        /*
        |--------------------------------------------------------------------------
        | AR DESIGNS
        |--------------------------------------------------------------------------
        */
        Schema::table('ar_designs', function (Blueprint $table) {
            $table->renameColumn('ar_design_id', 'id');
            $table->renameColumn('ar_design_status', 'status');
        });

        /*
        |--------------------------------------------------------------------------
        | AR ASSETS
        |--------------------------------------------------------------------------
        */
        Schema::table('ar_assets', function (Blueprint $table) {
            $table->renameColumn('ar_asset_id', 'id');
            $table->renameColumn('ar_asset_name', 'name');
        });

        /*
        |--------------------------------------------------------------------------
        | PAYMENTS
        |--------------------------------------------------------------------------
        */
        Schema::table('payments', function (Blueprint $table) {
            $table->renameColumn('payment_id', 'id');
            $table->renameColumn('payment_status', 'status');
        });

        /*
        |--------------------------------------------------------------------------
        | PAYMENT STAGES
        |--------------------------------------------------------------------------
        */
        Schema::table('payment_stages', function (Blueprint $table) {
            $table->renameColumn('payment_stage_id', 'id');
            $table->renameColumn('payment_stage_status', 'status');
        });

        /*
        |--------------------------------------------------------------------------
        | NOTIFICATIONS
        |--------------------------------------------------------------------------
        */
        Schema::table('notifications', function (Blueprint $table) {
            $table->renameColumn('notification_id', 'id');
        });

        /*
        |--------------------------------------------------------------------------
        | MESSAGES
        |--------------------------------------------------------------------------
        */
        Schema::table('messages', function (Blueprint $table) {
            $table->renameColumn('message_id', 'id');
        });

        /*
        |--------------------------------------------------------------------------
        | DOCUMENTATIONS
        |--------------------------------------------------------------------------
        */
        Schema::table('documentations', function (Blueprint $table) {
            $table->renameColumn('documentation_id', 'id');
        });

        /*
        |--------------------------------------------------------------------------
        | PROGRESS UPDATES
        |--------------------------------------------------------------------------
        */
        Schema::table('progress_updates', function (Blueprint $table) {
            $table->renameColumn('progress_update_id', 'id');
        });

        /*
        |--------------------------------------------------------------------------
        | PERSONAL FUNDS
        |--------------------------------------------------------------------------
        */
        Schema::table('personal_funds', function (Blueprint $table) {
            $table->renameColumn('personal_fund_id', 'id');
        });

        /*
        |--------------------------------------------------------------------------
        | EXPENSES
        |--------------------------------------------------------------------------
        */
        Schema::table('expenses', function (Blueprint $table) {
            $table->renameColumn('expense_id', 'id');
        });

        /*
        |--------------------------------------------------------------------------
        | MATERIALS
        |--------------------------------------------------------------------------
        */
        Schema::table('materials', function (Blueprint $table) {
            $table->renameColumn('material_id', 'id');
        });

        /*
        |--------------------------------------------------------------------------
        | SCHEDULES
        |--------------------------------------------------------------------------
        */
        Schema::table('schedules', function (Blueprint $table) {
            $table->renameColumn('schedule_id', 'id');
            $table->renameColumn('schedule_status', 'status');
        });

        /*
        |--------------------------------------------------------------------------
        | WORKS
        |--------------------------------------------------------------------------
        */
        Schema::table('works', function (Blueprint $table) {
            $table->renameColumn('work_id', 'id');
            $table->renameColumn('work_status', 'status');
        });

        /*
        |--------------------------------------------------------------------------
        | PROJECT AREAS
        |--------------------------------------------------------------------------
        */
        Schema::table('project_areas', function (Blueprint $table) {
            $table->renameColumn('project_area_id', 'id');
        });

        /*
        |--------------------------------------------------------------------------
        | PROJECTS
        |--------------------------------------------------------------------------
        */
        Schema::table('projects', function (Blueprint $table) {
            $table->renameColumn('project_id', 'id');
            $table->renameColumn('project_status', 'status');
        });

        /*
        |--------------------------------------------------------------------------
        | CLIENTS
        |--------------------------------------------------------------------------
        */
        Schema::table('clients', function (Blueprint $table) {
            $table->renameColumn('client_id', 'id');
        });

        /*
        |--------------------------------------------------------------------------
        | USERS
        |--------------------------------------------------------------------------
        */
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('user_id', 'id');
            $table->renameColumn('user_name', 'name');
        });
    }
};
