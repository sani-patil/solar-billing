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
    Schema::create('invoices', function (Blueprint $table) {
        $table->id();
        $table->foreignId('customer_id')->constrained()->onDelete('cascade');
        $table->string('invoice_number')->unique();
        $table->date('invoice_date');
        $table->decimal('sub_total', 15, 2);
        $table->decimal('gst_percentage', 5, 2)->default(18.00); // Solar  custom GST rates
        $table->decimal('gst_amount', 15, 2);
        $table->decimal('grand_total', 15, 2);
        $table->string('status')->default('unpaid'); // paid, unpaid, pending
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
