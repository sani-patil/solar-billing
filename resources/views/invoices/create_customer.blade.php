<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Customer / Client') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form action="{{ route('customers.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-sm font-bold text-gray-700 mb-1">Customer / Company Name</label>
                        <input type="text" name="name" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" placeholder="e.g. Tata Solar Nagpur Center" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-bold text-gray-700 mb-1">Contact Phone Number</label>
                        <input type="text" name="phone" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" placeholder="e.g. 9876543210" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-bold text-gray-700 mb-1">Email Address (Optional)</label>
                        <input type="email" name="email" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" placeholder="client@solarmail.com">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-bold text-gray-700 mb-1">GSTIN Number (Optional)</label>
                        <input type="text" name="gstin" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" placeholder="e.g. 27AAAAA1111A1Z1">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-bold text-gray-700 mb-1">Installation Site Address</label>
                        <textarea name="address" rows="3" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" placeholder="Enter complete site mapping address"></textarea>
                    </div>

                    <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                        <a href="{{ route('invoices.create') }}" class="text-sm font-semibold text-gray-600 hover:text-gray-900 transition">
                            ← Back to Billing
                        </a>
                        <button type="submit" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold uppercase text-xs tracking-wider rounded-md shadow-md transition">
                            Save Customer Account
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>