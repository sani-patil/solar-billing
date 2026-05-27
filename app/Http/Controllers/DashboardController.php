<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Invoice;

class DashboardController extends Controller
{
    public function index()
    {
        // Real permanent database counts setup
        $totalCustomers = Customer::count(); 
        $totalInvoices = Invoice::count();
        $totalRevenue = Invoice::where('status', 'paid')->sum('grand_total');
        
        // Latest entries feed to display on front table
        $recentInvoices = Invoice::with('customer')->latest()->take(5)->get(); 

        return view('dashboard', compact('totalCustomers', 'totalInvoices', 'totalRevenue', 'recentInvoices'));
    }
}