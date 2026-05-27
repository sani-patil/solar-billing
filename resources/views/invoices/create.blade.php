<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Dynamic Solar / Service Invoice') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form action="{{ route('invoices.store') }}" method="POST">
                    @csrf

                    <div class="mb-6 bg-blue-50 p-4 rounded-lg border border-blue-200">
                        <label class="block text-sm font-bold text-blue-900 mb-2">Choose Invoice Category Type</label>
                        <select name="invoice_type" id="invoice_type" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 font-bold text-sm" required>
                            <option value="materials">☀️ Solar Materials Package Layout (18% GST)</option>
                            <option value="services">🛠️ Installation, Services & Hiring Operations (5% Dynamic GST)</option>
                        </select>
                    </div>

                    <div class="mb-6">
                        <div class="flex justify-between items-center mb-2">
                            <label class="block text-sm font-bold text-gray-700">Select Registered Customer</label>
                            <a href="{{ route('customers.create') }}" class="text-xs font-bold uppercase tracking-wider text-blue-600 hover:text-blue-800 transition">
                                ➕ Register New Customer First
                            </a>
                        </div>
                        <select name="customer_id" class="block w-full rounded-md border-gray-300 shadow-sm text-sm" required>
                            <option value="">-- Choose Client From Database --</option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->name }} (📞 {{ $customer->phone }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6 p-4 bg-gray-50 rounded-lg border border-gray-200">
                        <div>
                            <label class="block text-xs font-bold text-gray-600 uppercase mb-1">Buyer's Order No.</label>
                            <input type="text" name="buyers_order_no" class="w-full rounded-md border-gray-300 text-sm" placeholder="e.g., GEMC-511687703...">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-600 uppercase mb-1">Destination Location</label>
                            <input type="text" name="destination" class="w-full rounded-md border-gray-300 text-sm" placeholder="e.g., NAGPUR">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-600 uppercase mb-1">Dispatched Through</label>
                            <input type="text" name="dispatched_through" class="w-full rounded-md border-gray-300 text-sm" placeholder="e.g., By Road / Courier">
                        </div>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-sm font-bold text-gray-800 uppercase tracking-wider mb-3">Invoice Ledger / Particulars Matrix</h3>
                        
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200" id="items_table">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-2 text-left text-xs font-bold text-gray-500 uppercase">Particulars Description</th>
                                        <th class="px-4 py-2 text-left text-xs font-bold text-gray-500 uppercase w-32">HSN/SAC</th>
                                        <th class="px-4 py-2 text-center text-xs font-bold text-gray-500 uppercase w-20">QTY</th>
                                        <th class="px-4 py-2 text-right text-xs font-bold text-gray-500 uppercase w-36">Rate (₹)</th>
                                        <th class="px-4 py-2 text-right text-xs font-bold text-gray-500 uppercase w-36">Total Amount</th>
                                        <th class="px-4 py-2 text-center w-12"></th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white" id="items_container">
                                    <tr class="item-row">
                                        <td class="p-2">
                                            <input type="text" name="items[0][name]" class="w-full rounded-md border-gray-300 text-sm" placeholder="Description details" required>
                                        </td>
                                        <td class="p-2">
                                            <input type="text" name="items[0][hsn_sac]" class="w-full rounded-md border-gray-300 text-sm font-mono" placeholder="e.g., 996412">
                                        </td>
                                        <td class="p-2">
                                            <input type="number" name="items[0][qty]" class="qty-input w-full rounded-md border-gray-300 text-center text-sm" value="1" min="1" required>
                                        </td>
                                        <td class="p-2">
                                            <input type="number" name="items[0][rate]" step="0.01" class="rate-input w-full rounded-md border-gray-300 text-right text-sm" placeholder="0.00" required>
                                        </td>
                                        <td class="p-2 text-right text-sm font-semibold text-gray-700 px-4 row-total-span">₹0.00</td>
                                        <td class="p-2 text-center">
                                            <button type="button" class="text-red-500 hover:text-red-700 font-bold remove-row-btn">×</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4">
                            <button type="button" id="add_row_btn" class="inline-flex items-center px-4 py-2 bg-gray-800 hover:bg-gray-900 text-white text-xs font-bold uppercase tracking-wider rounded transition">
                                + Add Ledger Row Item
                            </button>
                        </div>
                    </div>

                    <div class="bg-gray-50 p-5 rounded-lg mb-6 border border-gray-200 shadow-sm max-w-md ml-auto">
                        <div class="flex justify-between text-sm text-gray-600 mb-2">
                            <span>Sub-Total Taxable Value:</span>
                            <span class="font-bold text-gray-800">₹<span id="live_subtotal">0.00</span></span>
                        </div>
                        <div class="flex justify-between text-sm text-gray-600 mb-2">
                            <span id="gst_label">Integrated GST (18%):</span>
                            <span class="font-bold text-gray-800">₹<span id="live_gst">0.00</span></span>
                        </div>
                        <div class="flex justify-between text-lg font-bold text-gray-900 border-t border-gray-300 pt-3 mt-2">
                            <span>Grand Total Amount:</span>
                            <span class="text-green-600">₹<span id="live_grandtotal">0.00</span></span>
                        </div>
                    </div>

                    <div class="flex justify-between items-center border-t border-gray-100 pt-4">
                        <a href="/dashboard" class="text-sm font-semibold text-gray-600 hover:text-gray-900">← Cancel</a>
                        <button type="submit" class="inline-flex items-center px-6 py-3 bg-green-600 hover:bg-green-700 text-white text-sm font-bold uppercase tracking-wider rounded-md shadow-md transition">
                            Generate Digital Document
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script>
        let rowIndex = 1;
        const container = document.getElementById('items_container');
        const addBtn = document.getElementById('add_row_btn');
        const typeSelect = document.getElementById('invoice_type');

        typeSelect.addEventListener('change', calculateGrandTotals);

        addBtn.addEventListener('click', function() {
            const tr = document.createElement('tr');
            tr.className = 'item-row';
            tr.innerHTML = `
                <td class="p-2">
                    <input type="text" name="items[${rowIndex}][name]" class="w-full rounded-md border-gray-300 text-sm" placeholder="Description details" required>
                </td>
                <td class="p-2">
                    <input type="text" name="items[${rowIndex}][hsn_sac]" class="w-full rounded-md border-gray-300 text-sm font-mono" placeholder="e.g., 996412">
                </td>
                <td class="p-2">
                    <input type="number" name="items[${rowIndex}][qty]" class="qty-input w-full rounded-md border-gray-300 text-center text-sm" value="1" min="1" required>
                </td>
                <td class="p-2">
                    <input type="number" name="items[${rowIndex}][rate]" step="0.01" class="rate-input w-full rounded-md border-gray-300 text-right text-sm" placeholder="0.00" required>
                </td>
                <td class="p-2 text-right text-sm font-semibold text-gray-700 px-4 row-total-span">₹0.00</td>
                <td class="p-2 text-center">
                    <button type="button" class="text-red-500 hover:text-red-700 font-bold remove-row-btn">×</button>
                </td>
            `;
            container.appendChild(tr);
            rowIndex++;
            attachCalculations();
        });

        container.addEventListener('click', function(e) {
            if(e.target.classList.contains('remove-row-btn')) {
                const rows = container.getElementsByClassName('item-row');
                if(rows.length > 1) {
                    e.target.closest('tr').remove();
                    calculateGrandTotals();
                }
            }
        });

        function attachCalculations() {
            const rows = container.getElementsByClassName('item-row');
            for(let row of rows) {
                const qtyInput = row.querySelector('.qty-input');
                const rateInput = row.querySelector('.rate-input');
                qtyInput.addEventListener('input', calculateRowTotal);
                rateInput.addEventListener('input', calculateRowTotal);
            }
        }

        function calculateRowTotal(e) {
            const row = e.target.closest('tr');
            const qty = parseFloat(row.querySelector('.qty-input').value) || 0;
            const rate = parseFloat(row.querySelector('.rate-input').value) || 0;
            const total = qty * rate;
            row.querySelector('.row-total-span').innerText = '₹' + total.toFixed(2);
            calculateGrandTotals();
        }

        function calculateGrandTotals() {
            const rows = container.getElementsByClassName('item-row');
            let subTotal = 0;
            
            for(let row of rows) {
                const qty = parseFloat(row.querySelector('.qty-input').value) || 0;
                const rate = parseFloat(row.querySelector('.rate-input').value) || 0;
                subTotal += (qty * rate);
            }

            // Read chosen routing profile type
            const type = typeSelect.value;
            let gstPercentage = (type === 'services') ? 5 : 18;
            let gstLabelText = (type === 'services') ? 'Dynamic CGST+SGST (5%):' : 'Integrated GST (18%):';
            
            const gst = (subTotal * gstPercentage) / 100;
            const grandTotal = subTotal + gst;

            document.getElementById('gst_label').innerText = gstLabelText;
            document.getElementById('live_subtotal').innerText = subTotal.toFixed(2);
            document.getElementById('live_gst').innerText = gst.toFixed(2);
            document.getElementById('live_grandtotal').innerText = grandTotal.toFixed(2);
        }

        attachCalculations();
    </script>
</x-app-layout>