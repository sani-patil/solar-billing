<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController; 
use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Welcome / Root URL Redirection
Route::get('/', function () {
    return redirect('/dashboard');
});

// Main Dashboard Route
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Authenticated Routes Group (All Secure Operations Inside)
Route::middleware('auth')->group(function () {
    
    // 1. Profile Management Defaults
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 2. Invoices Management Systems
    Route::get('/invoices/create', [InvoiceController::class, 'create'])->name('invoices.create');
    Route::post('/invoices', [InvoiceController::class, 'store'])->name('invoices.store');
    Route::get('/invoices/{id}/print', [InvoiceController::class, 'print'])->name('invoices.print');
    
    // 🔄 FIXED TOGGLE ROUTE: Allows seamless switching between Proforma (PI) and Tax Invoice (PO)
    Route::post('/invoices/{id}/toggle', [InvoiceController::class, 'toggleStatus'])->name('invoices.toggle');

    // 3. Customers Management Systems
    Route::get('/customers/create', [InvoiceController::class, 'createCustomer'])->name('customers.create');
    Route::post('/customers', [InvoiceController::class, 'storeCustomer'])->name('customers.store');

});

require __DIR__.'/auth.php';