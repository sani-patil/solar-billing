<x-app-layout>
    <x-slot name="header">
        <div style="display: flex; align-items: center; justify-content: space-between; background: #ffffff; padding: 4px 0px;">
            <div style="display: flex; align-items: center; gap: 15px;">
                <div style="background: linear-gradient(135deg, #f59e0b, #ea580c); padding: 12px; border-radius: 12px; box-shadow: 0 4px 12px rgba(234, 88, 12, 0.3); display: flex; align-items: center; justify-content: center;">
                    <svg style="width: 24px; height: 24px; color: #ffffff;" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m12.728 0l-.707-.707M6.343 6.343l-.707-.707M14 12a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <div>
                    <h2 style="font-weight: 900; font-size: 24px; color: #111827; letter-spacing: -0.5px; text-transform: uppercase; margin: 0; font-family: sans-serif;">
                        Solar Planet <span style="font-size: 11px; font-weight: 800; color: #f97316; letter-spacing: 2px; display: block;">BILLING CONTROL HUB</span>
                    </h2>
                </div>
            </div>
            <div>
                <span style="font-size: 11px; font-weight: 700; font-family: monospace; background: #eff6ff; color: #1d4ed8; padding: 6px 12px; border-radius: 8px; border: 1px solid #bfdbfe;">
                    📍 Nagpur HQ Status: Active
                </span>
            </div>
        </div>
    </x-slot>

    <div style="background-color: #f3f4f6; padding: 40px 0px; min-h: 100vh;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                
                <div style="background: #ffffff; border-radius: 16px; border-left: 6px solid #2563eb; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05); padding: 24px;">
                    <div style="display: flex; align-items: center;">
                        <div style="background: #eff6ff; color: #2563eb; padding: 14px; border-radius: 12px; margin-right: 16px; display: flex; align-items: center;">
                            <svg style="width: 28px; height: 28px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p style="font-size: 11px; font-weight: 700; color: #9ca3af; text-transform: uppercase; tracking: 1px; margin: 0;">Total Active Customers</p>
                            <p style="font-size: 28px; font-weight: 900; color: #1f2937; margin: 4px 0 0 0;">{{ $totalCustomers }}</p>
                        </div>
                    </div>
                </div>

                <div style="background: #ffffff; border-radius: 16px; border-left: 6px solid #d97706; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05); padding: 24px;">
                    <div style="display: flex; align-items: center;">
                        <div style="background: #fef3c7; color: #d97706; padding: 14px; border-radius: 12px; margin-right: 16px; display: flex; align-items: center;">
                            <svg style="width: 28px; height: 28px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <p style="font-size: 11px; font-weight: 700; color: #9ca3af; text-transform: uppercase; tracking: 1px; margin: 0;">Invoices Generated</p>
                            <p style="font-size: 28px; font-weight: 900; color: #1f2937; margin: 4px 0 0 0;">{{ $totalInvoices }}</p>
                        </div>
                    </div>
                </div>

                <div style="background: #ffffff; border-radius: 16px; border-left: 6px solid #059669; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05); padding: 24px;">
                    <div style="display: flex; align-items: center;">
                        <div style="background: #e6f4ea; color: #059669; width: 56px; height: 56px; border-radius: 12px; margin-right: 16px; display: flex; align-items: center; justify-content: center;">
                            <span style="font-size: 26px; font-weight: 900;">₹</span>
                        </div>
                        <div>
                            <p style="font-size: 11px; font-weight: 700; color: #9ca3af; text-transform: uppercase; tracking: 1px; margin: 0;">Total Gross Revenue</p>
                            <p style="font-size: 28px; font-weight: 900; color: #059669; margin: 4px 0 0 0;">₹{{ number_format($totalRevenue, 2) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div style="background: #ffffff; border-radius: 16px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); border: 1px solid #e5e7eb; overflow: hidden;">
                <div style="padding: 24px; background: #f9fafb; border-bottom: 1px solid #f3f4f6; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
                    <div>
                        <h3 style="font-size: 18px; font-weight: 800; color: #111827; margin: 0;">Recent Financial Invoices</h3>
                        <p style="font-size: 12px; color: #6b7280; margin: 4px 0 0 0;">Real-time solar panel sales & operational service ledger logs.</p>
                    </div>
                    <a href="{{ route('invoices.create') }}" style="background: linear-gradient(to right, #ea580c, #d97706); color: #ffffff; font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; padding: 12px 24px; border-radius: 10px; box-shadow: 0 4px 14px rgba(234, 88, 12, 0.3); transition: all 0.2s; border: none; text-decoration: none;">
                        + Create New Invoice
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead style="background: #f3f4f6;">
                            <tr style="font-size: 10px; font-weight: 700; color: #4b5563; text-transform: uppercase; letter-spacing: 1px;">
                                <th class="px-6 py-4 text-left">Document ID</th>
                                <th class="px-6 py-4 text-left">Buyer / Client Details</th>
                                <th class="px-6 py-4 text-left">Date Generated</th>
                                <th class="px-6 py-4 text-right">Grand Amount</th>
                                <th class="px-6 py-4 text-center">Status Track</th>
                                <th class="px-6 py-4 text-center">Execution Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100 text-sm font-medium text-gray-700">
                            @forelse($recentInvoices as $invoice)
                                <tr class="hover:bg-gray-50/80 transition duration-150">
                                    
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if(str_starts_with($invoice->invoice_number, 'SRV'))
                                            <span style="color: #7c3aed; background: #f5f3ff; border: 1px solid #ddd6fe; padding: 4px 10px; border-radius: 6px; font-weight: 700; font-family: monospace; font-size: 12px;">{{ $invoice->invoice_number }}</span>
                                        @else
                                            <span style="color: #2563eb; background: #eff6ff; border: 1px solid #bfdbfe; padding: 4px 10px; border-radius: 6px; font-weight: 700; font-family: monospace; font-size: 12px;">{{ $invoice->invoice_number }}</span>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div style="font-weight: 700; color: #111827; font-size: 14px;">{{ $invoice->customer->name ?? 'Unknown Customer' }}</div>
                                        <div style="font-size: 11px; color: #6b7280; font-family: monospace; margin-top: 2px;">📞 {{ $invoice->customer->phone ?? 'N/A' }}</div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap style-date" style="color: #4b5563;">
                                        {{ \Carbon\Carbon::parse($invoice->invoice_date)->format('d M, Y') }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-right" style="font-weight: 800; color: #111827; font-family: monospace; font-size: 14px;">
                                        ₹{{ number_format($invoice->grand_total, 2) }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <form action="{{ route('invoices.toggle', $invoice->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            <button type="submit" style="background: none; border: none; cursor: pointer; padding: 0;">
                                                @if($invoice->status == 'paid')
                                                    <span style="color: #065f46; background: #d1fae5; border: 1px solid #a7f3d0; padding: 6px 14px; border-radius: 9999px; font-size: 10px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px;">
                                                        Paid ✓
                                                    </span>
                                                @else
                                                    <span style="color: #92400e; background: #fef3c7; border: 1px solid #fde68a; padding: 6px 14px; border-radius: 9999px; font-size: 10px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px;">
                                                        Unpaid ⏳
                                                    </span>
                                                @endif
                                            </button>
                                        </form>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-center" style="font-size: 0;">
                                        <a href="{{ route('invoices.print', $invoice->id) }}" target="_blank" style="background: #1f2937; color: #ffffff; font-size: 10px; font-weight: 800; text-transform: uppercase; padding: 8px 14px; border-radius: 6px; text-decoration: none; margin-right: 6px; display: inline-block;">
                                            Print 🖨️
                                        </a>

                                        @php
                                            $whatsappNumber = $invoice->customer->phone ?? '';
                                            $billTypeLabel = ($invoice->status == 'unpaid') ? "📝 *Proforma Invoice (Estimate)*" : "📄 *Original Tax Invoice*";
                                            $extraNote = ($invoice->status == 'unpaid') ? "Note: This is an estimated bill sent before order finalization." : "Note: This is a confirmed digital tax bill receipt.";

                                            $messageText = "Hello " . ($invoice->customer->name ?? 'Customer') . ",\n\nYour Solar System billing statement has been generated successfully!\n\n" . $billTypeLabel . "\n*Invoice No:* " . $invoice->invoice_number . "\n💰 *Grand Total:* ₹" . number_format($invoice->grand_total, 2) . " (Incl. GST)\n\n" . $extraNote . "\n\nThank you for choosing Solar Planet! ☀️";
                                            $encodedMessage = urlencode($messageText);
                                        @endphp
                                        
                                        <a href="https://api.whatsapp.com/send?phone={{ $whatsappNumber }}&text={{ $encodedMessage }}" target="_blank" style="background: #10b981; color: #ffffff; font-size: 10px; font-weight: 800; text-transform: uppercase; padding: 8px 14px; border-radius: 6px; text-decoration: none; display: inline-block;">
                                            Share 💬
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" style="padding: 32px; text-align: center; font-size: 12px; font-weight: 700; color: #9ca3af; text-transform: uppercase; letter-spacing: 1px; background: #f9fafb;">
                                        ⚠ No invoice statements registered in solar matrix yet.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>