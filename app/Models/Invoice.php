<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    // 🚨 FIXED: Added all new service tracking and dynamic GST columns for mass assignment
    protected $fillable = [
        'customer_id',
        'invoice_type',         // materials services 
        'invoice_number',
        'buyers_order_no',      //  Buyer's Order Number
        'destination',          // Destination  NAGPUR)
        'dispatched_through',   // Dispatched Through 
        'invoice_date',
        'sub_total',
        'gst_percentage',
        'gst_amount',
        'cgst_amount',          
        'sgst_amount',        
        'grand_total',
        'status',
    ];

    /**
     * Relationship: An invoice belongs to a specific customer.
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    /**
     * Relationship: One Invoice can have multiple dynamic listed item rows (Materials / Services).
     */
    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }
}