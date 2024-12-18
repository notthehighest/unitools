<x-adminlayout.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Equipment Income Report') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-6">

        <!-- Filters -->
        <form method="GET" action="{{ route('sales_report.index') }}" class="mb-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <div class="col-span-1">
                <label for="start_date" class="block text-gray-700 font-medium">Start Date:</label>
                <input type="date" name="start_date" id="start_date" value="{{ request('start_date') ?? $startDate->format('Y-m-d') }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500">
            </div>
            <div class="col-span-1">
                <label for="end_date" class="block text-gray-700 font-medium">End Date:</label>
                <input type="date" name="end_date" id="end_date" value="{{ request('end_date') ?? $endDate->format('Y-m-d') }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500">
            </div>
            <div class="col-span-1">
                <label for="equipment_id" class="block text-gray-700 font-medium">Equipment:</label>
                <select name="equipment_id" id="equipment_id" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500">
                    <option value="">All Equipment</option>
                    @foreach($equipments as $equipment)
                        <option value="{{ $equipment->id }}" {{ $equipmentId == $equipment->id ? 'selected' : '' }}>{{ $equipment->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-span-1 flex justify-center items-end">
                <button type="submit" class="w-full mt-4 py-2 px-6 bg-green-600 text-white font-semibold rounded-md hover:bg-green-700 focus:ring-4 focus:ring-green-300">Filter</button>
            </div>
        </form>

        <!-- Summary Boxes -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded-lg shadow-lg border border-green-100">
                <h5 class="text-xl font-semibold text-green-700">Total Income</h5>
                <p class="text-2xl text-green-600">{{ number_format($totalSales, 2) }} PHP</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-lg border border-green-100">
                <h5 class="text-xl font-semibold text-green-700">Monthly Income</h5>
                <ul class="space-y-2">
                    @foreach($monthlySales as $sale)
                        <li class="text-2xl text-green-600">
                            {{ \Carbon\Carbon::createFromFormat('Y-m', $sale->year . '-' . $sale->month)->format('F Y') }}: {{ number_format($sale->monthly_sales, 2) }} PHP
                        </li>
                    @endforeach
                </ul>
            </div>

        </div>

        <!-- Sales Table -->
        <div class="overflow-x-auto bg-white p-6 rounded-lg shadow-lg border border-green-100">
            <table class="min-w-full table-auto text-left">
                <thead class="bg-green-500 text-white">
                    <tr>
                        <th class="px-6 py-3 text-sm font-medium">Equipment Name</th>
                        <th class="px-6 py-3 text-sm font-medium">Price (PHP)</th>
                        <th class="px-6 py-3 text-sm font-medium">Total Borrowed</th>
                        <th class="px-6 py-3 text-sm font-medium">Total Income (PHP)</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($equipmentSales as $sale)
                        <tr>
                            <td class="px-6 py-4">{{ $sale->equipment_name }}</td>
                            <td class="px-6 py-4">{{ number_format($sale->equipment_price, 2) }}</td>
                            <td class="px-6 py-4">{{ $sale->total_borrowed }}</td>
                            <td class="px-6 py-4">{{ number_format($sale->total_sales, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-adminlayout.app>
