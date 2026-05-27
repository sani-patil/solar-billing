<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $invoice->invoice_number }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print { 
            .no-print { display: none !important; } 
            body { background: white; color: black; } 
        }
    </style>
</head>
<body class="bg-gray-100 font-sans p-4 sm:p-8 antialiased">

    <div class="max-w-4xl mx-auto mb-6 no-print flex justify-between items-center bg-white p-4 rounded-lg shadow border border-gray-200">
        <a href="/dashboard" class="text-sm font-bold text-gray-600 hover:text-gray-900">← Back to Dashboard</a>
        <div class="flex space-x-3">
            <form action="/invoices/{{ $invoice->id }}/toggle" method="POST" class="inline">
                @csrf
                <button type="submit" class="px-4 py-2 bg-gray-800 hover:bg-gray-900 text-white font-bold text-xs uppercase rounded transition">
                    🔄 Switch PI / PO
                </button>
            </form>
            <button onclick="window.print()" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs uppercase rounded shadow transition">
                🖨️ Print / Save PDF
            </button>
        </div>
    </div>

    <div class="max-w-4xl mx-auto bg-white p-8 sm:p-12 border border-gray-300 relative text-xs text-gray-800 shadow-sm">
        
        <div class="text-center mb-6">
            <h1 class="text-4xl font-extrabold tracking-wider text-orange-600 uppercase" style="font-family: 'Georgia', serif;">Solar Planet</h1>
            <p class="text-sm font-bold text-gray-700 tracking-wide mt-1">Installation & Services</p>
            <div class="border-b-2 border-gray-800 mt-2"></div>
            <p class="text-xs font-black uppercase bg-gray-100 py-1 border-b border-gray-800 tracking-widest text-gray-700">
                {{ $invoice->invoice_type === 'services' ? 'GST SERVICE INVOICE' : 'GST TAX INVOICE' }}
            </p>
        </div>

        <div class="grid grid-cols-2 border border-gray-800 mb-6">
            <div class="p-3 border-r border-gray-800 space-y-1">
                <p class="font-bold text-sm text-gray-900">SOLAR PLANET</p>
                <p>Anant Nagar, Near Girja Apartment, Nagpur-440013</p>
                <p>Solarplanet28@gmail.com</p>
                <p class="font-bold pt-1 font-mono text-gray-900">GSTIN/UIN: 27FCVPS3707L1ZO</p>
                <p>State Name: <span class="font-semibold">Maharashtra</span> (Code: 27)</p>
            </div>
            <div class="grid grid-cols-2 font-mono">
                <div class="p-2 border-b border-r border-gray-800">Invoice No:<br><strong class="text-sm text-gray-900">{{ $invoice->invoice_number }}</strong></div>
                <div class="p-2 border-b border-gray-800">Dated:<br><strong>{{ \Carbon\Carbon::parse($invoice->invoice_date)->format('d/m/Y') }}</strong></div>
                <div class="p-2 border-b border-r border-gray-800">Buyer's Order No:<br><strong>{{ $invoice->buyers_order_no ?? 'N/A' }}</strong></div>
                <div class="p-2 border-b border-gray-800">Destination:<br><strong>{{ $invoice->destination ?? 'NAGPUR' }}</strong></div>
                <div class="p-2 border-r border-gray-800">Dispatched through:<br><strong>{{ $invoice->dispatched_through ?? 'N/A' }}</strong></div>
                <div class="p-2">Status Layout:<br><strong class="uppercase text-blue-600">{{ $invoice->status === 'unpaid' ? 'PROFORMA' : 'PO ORIGINAL' }}</strong></div>
            </div>
        </div>

        <div class="border border-gray-800 p-3 bg-gray-50/50 mb-6">
            <h3 class="font-bold uppercase tracking-wider text-gray-400 mb-1 text-[10px]">Details of Buyer (Bill to):</h3>
            <p class="text-sm font-bold text-gray-900">{{ $invoice->customer->name ?? 'None' }}</p>
            <p class="mt-0.5 whitespace-pre-line text-gray-600 font-medium">{{ $invoice->customer->address ?? 'Not Specified' }}</p>
            <p class="font-medium mt-1 font-mono text-gray-700">📞 {{ $invoice->customer->phone ?? 'N/A' }} @if($invoice->customer->gstin) | GSTIN: {{ $invoice->customer->gstin }} @endif</p>
        </div>

        <table class="w-full border-collapse border border-gray-800 mb-4">
            <thead>
                <tr class="bg-gray-100 border-b border-gray-800 text-[11px] font-bold text-gray-700">
                    <th class="border-r border-gray-800 px-2 py-2 text-center w-10">Sr No.</th>
                    <th class="border-r border-gray-800 px-3 py-2 text-left">Particulars Description</th>
                    <th class="border-r border-gray-800 px-2 py-2 text-center w-24">HSN/SAC</th>
                    <th class="border-r border-gray-800 px-2 py-2 text-center w-16">Quantity</th>
                    <th class="border-r border-gray-800 px-3 py-2 text-right w-24">Rate (₹)</th>
                    <th class="px-3 py-2 text-right w-28">Amount (₹)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($invoice->items as $index => $item)
                    <tr class="border-b border-gray-800">
                        <td class="border-r border-gray-800 px-2 py-3 text-center font-mono text-gray-500">{{ $index + 1 }}</td>
                        <td class="border-r border-gray-800 px-3 py-3 font-bold text-gray-900 uppercase tracking-wide">
                            {{ $item->item_name }}
                            @if($invoice->invoice_type === 'services')
                                <div class="text-[10px] font-normal text-blue-600 lowercase mt-1 font-mono">
                                    output cgst @2.5% <br> output sgst @2.5%
                                </div>
                            @endif
                        </td>
                        <td class="border-r border-gray-800 px-2 py-3 text-center font-mono font-bold text-gray-750">{{ $item->hsn_sac ?? '—' }}</td>
                        <td class="border-r border-gray-800 px-2 py-3 text-center font-medium">{{ $item->quantity }}</td>
                        <td class="border-r border-gray-800 px-3 py-3 text-right font-mono text-gray-600">₹{{ number_format($item->rate, 2) }}</td>
                        <td class="px-3 py-3 text-right font-bold font-mono text-gray-900">₹{{ number_format($item->total, 2) }}</td>
                    </tr>
                @endforeach
                <tr class="border-t border-gray-800 font-bold bg-gray-50 text-gray-800">
                    <td colspan="5" class="border-r border-gray-800 px-3 py-2 text-right uppercase tracking-wider text-[10px]">Total Taxable Base Value:</td>
                    <td class="px-3 py-2 text-right font-mono text-sm text-gray-900">₹{{ number_format($invoice->sub_total, 2) }}</td>
                </tr>
            </tbody>
        </table>

        <div class="mt-4 border border-gray-800">
            <div class="bg-gray-100 p-1.5 font-bold border-b border-gray-800 Log-header uppercase tracking-widest text-[10px] text-gray-700">GST Tax Breakup Matrix</div>
            <table class="w-full text-center font-mono text-[11px] border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-800 font-bold text-gray-600">
                        <th class="border-r border-gray-800 py-1.5">HSN/SAC</th>
                        <th class="border-r border-gray-800 py-1.5">Taxable Value</th>
                        @if($invoice->invoice_type === 'services')
                            <th class="border-r border-gray-800 py-1.5">CGST (2.5%)</th>
                            <th class="border-r border-gray-800 py-1.5">SGST (2.5%)</th>
                        @else
                            <th class="border-r border-gray-800 py-1.5">IGST (18%)</th>
                        @endif
                        <th class="py-1.5">Total Tax Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border-r border-gray-800 py-2 font-bold text-gray-900">{{ $invoice->items->first()->hsn_sac ?? '996412' }}</td>
                        <td class="border-r border-gray-800 py-2">₹{{ number_format($invoice->sub_total, 2) }}</td>
                        @if($invoice->invoice_type === 'services')
                            <td class="border-r border-gray-800 py-2 text-gray-600">₹{{ number_format($invoice->cgst_amount, 2) }}</td>
                            <td class="border-r border-gray-800 py-2 text-gray-600">₹{{ number_format($invoice->sgst_amount, 2) }}</td>
                        @else
                            <td class="border-r border-gray-800 py-2 text-gray-600">₹{{ number_format($invoice->gst_amount, 2) }}</td>
                        @endif
                        <td class="py-2 font-bold text-gray-900">₹{{ number_format($invoice->gst_amount, 2) }}</td>
                    </tr>
                    <tr class="border-t border-gray-800 bg-gray-100 font-bold text-gray-800">
                        <td class="border-r border-gray-800 py-1.5 text-right px-2 uppercase text-[10px]">Total:</td>
                        <td class="border-r border-gray-800 py-1.5">₹{{ number_format($invoice->sub_total, 2) }}</td>
                        @if($invoice->invoice_type === 'services')
                            <td class="border-r border-gray-800 py-1.5">₹{{ number_format($invoice->cgst_amount, 2) }}</td>
                            <td class="border-r border-gray-800 py-1.5">₹{{ number_format($invoice->sgst_amount, 2) }}</td>
                        @else
                            <td class="border-r border-gray-800 py-1.5">₹{{ number_format($invoice->gst_amount, 2) }}</td>
                        @endif
                        <td class="py-1.5 text-blue-700 font-bold">₹{{ number_format($invoice->gst_amount, 2) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="mt-6 p-4 border border-gray-800 bg-gray-900 text-white rounded-md flex justify-between items-center relative z-10">
            <div>
                <p class="text-[10px] uppercase text-gray-400 font-bold tracking-wider">Final Total Bill Amount (In Words):</p>
                <p class="text-xs font-semibold font-mono mt-0.5 text-yellow-300">
                    INR {{ ucwords(str_replace('-', ' ', \Illuminate\Support\Str::slug($invoice->grand_total))) }} Only
                </p>
            </div>
            <div class="text-right border-l border-gray-700 pl-6">
                <span class="text-[10px] block uppercase text-gray-400 font-bold tracking-wider">NET GRAND TOTAL:</span>
                <span class="text-2xl font-black font-mono text-green-400">₹{{ number_format($invoice->grand_total, 2) }}</span>
            </div>
        </div>

        <div class="mt-6 grid grid-cols-2 gap-6 items-end">
            <div class="border border-gray-300 rounded p-3 bg-gray-50/50 font-mono text-[11px] space-y-0.5">
                <h4 class="font-bold uppercase tracking-wide text-gray-500 border-b pb-1 mb-1.5 text-[10px]">🏦 Company Bank Account Details</h4>
                <p>Bank Name: <span class="font-bold text-gray-900">CANARA BANK</span></p>
                <p>Account Holder: <span class="font-bold text-gray-900">SOLAR PLANET SOLAR INSTALLATION AND TRADING</span></p>
                <p>A/c Number: <span class="text-blue-700 font-bold text-xs">1488201012394</span></p>
                <p>IFSC Code: <span class="font-bold text-gray-900">CNRB0001488</span></p>
                <p>Branch Name: <span class="text-gray-900">Sadar Bazar, Nagpur</span></p>
            </div>
            <div class="text-center font-mono text-[10px] text-gray-400 space-y-0.5 pb-1">
                <p class="font-bold uppercase text-gray-800 text-[11px] tracking-wide">SOLAR PLANET</p>
                <br><br><br>
                <p class="border-t border-gray-300 pt-1 text-gray-500">Authorized Signatory / Digital Document</p>
            </div>
        </div>

    </div>
</body>
</html>