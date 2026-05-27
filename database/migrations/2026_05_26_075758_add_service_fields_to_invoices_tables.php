<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Add corporate tracking fields to main invoices table
        Schema::table('invoices', function (Blueprint $table) {
            $table->string('invoice_type')->default('materials')->after('customer_id'); // materials or services
            $table->string('buyers_order_no')->nullable()->after('invoice_number');
            $table->string('destination')->nullable()->after('buyers_order_no');
            $table->string('dispatched_through')->nullable()->after('destination');
            $table->decimal('cgst_amount', 15, 2)->default(0.00)->after('gst_amount');
            $table->decimal('sgst_amount', 15, 2)->default(0.00)->after('cgst_amount');
        });

        // Add HSN/SAC tracking to individual items rows
        Schema::table('invoice_items', function (Blueprint $table) {
            $table->string('hsn_sac')->nullable()->after('item_name');
        });
    }

    public function down(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropColumn(['invoice_type', 'buyers_order_no', 'destination', 'dispatched_through', 'cgst_amount', 'sgst_amount']);
        });

        Schema::table('invoice_items', function (Blueprint $table) {
            $table->dropColumn('hsn_sac');
        });
    }
};