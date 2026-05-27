<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceItem;

class InvoiceController extends Controller
{
    public function create()
    {
        $customers = Customer::latest()->get(); 
        return view('invoices.create', compact('customers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'invoice_type' => 'required|in:materials,services',
            'items' => 'required|array|min:1',
            'items.*.name' => 'required|string',
            'items.*.qty' => 'required|integer|min:1',
            'items.*.rate' => 'required|numeric|min:0',
        ]);

        $subTotal = 0;
        $itemsData = [];

        foreach ($request->items as $item) {
            $rowTotal = $item['qty'] * $item['rate'];
            $subTotal += $rowTotal;
            
            $itemsData[] = [
                'item_name' => $item['name'],
                'hsn_sac' => $item['hsn_sac'] ?? null,
                'quantity' => $item['qty'],
                'rate' => $item['rate'],
                'total' => $rowTotal
            ];
        }

        // 🚨 Dynamic Tax Multi-Route Decision Matrix
        $cgstAmount = 0.00;
        $sgstAmount = 0.00;
        
        if ($request->invoice_type === 'services') {
            $gstPercentage = 5.00; // Total 5% for Hiring / Services
            $gstAmount = ($subTotal * $gstPercentage) / 100;
            $cgstAmount = $gstAmount / 2; // 2.5%
            $sgstAmount = $gstAmount / 2; // 2.5%
        } else {
            $gstPercentage = 18.00; // Standard 18% for Solar Materials
            $gstAmount = ($subTotal * $gstPercentage) / 100;
        }

        $grandTotal = $subTotal + $gstAmount;

        $latestInvoice = Invoice::latest()->first();
        $nextId = $latestInvoice ? $latestInvoice->id + 1 : 1;
        $prefix = $request->invoice_type === 'services' ? 'SRV-' : 'INV-';
        $invoiceNumber = $prefix . date('Y') . '-' . str_pad($nextId, 4, '0', STR_PAD_LEFT);

        $invoice = Invoice::create([
            'customer_id' => $request->customer_id,
            'invoice_type' => $request->invoice_type,
            'invoice_number' => $invoiceNumber,
            'buyers_order_no' => $request->buyers_order_no,
            'destination' => $request->destination,
            'dispatched_through' => $request->dispatched_through,
            'invoice_date' => date('Y-m-d'),
            'sub_total' => $subTotal,
            'gst_percentage' => $gstPercentage,
            'gst_amount' => $gstAmount,
            'cgst_amount' => $cgstAmount,
            'sgst_amount' => $sgstAmount,
            'grand_total' => $grandTotal,
            'status' => 'unpaid'
        ]);

        foreach ($itemsData as $data) {
            $invoice->items()->create($data);
        }

        return redirect('/dashboard')->with('success', 'Dynamic Solar Billing Invoice Generated!');
    }

    public function createCustomer()
    {
        return view('invoices.create_customer');
    }

    public function storeCustomer(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
        ]);

        Customer::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'gstin' => $request->gstin,
            'address' => $request->address,
        ]);

        return redirect()->route('invoices.create')->with('success', 'Customer Added Successfully!');
    }

    public function print($id)
    {
        $invoice = Invoice::with(['customer', 'items'])->findOrFail($id);
        return view('invoices.print', compact('invoice'));
    }

    public function toggleStatus($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->status = ($invoice->status == 'unpaid') ? 'paid' : 'unpaid';
        $invoice->save();

        return back()->with('success', 'Invoice Billing Status Updated Successfully!');
    }
}