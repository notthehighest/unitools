<x-adminlayout.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-6">
        <!-- Dashboard Summary -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Total Farmers -->
            <div class="bg-white p-6 rounded-lg shadow-md border border-green-100">
                <h3 class="text-lg font-semibold text-green-700">Total Farmers</h3>
                <p class="text-2xl text-green-600">{{ $totalFarmers }}</p>
            </div>

            <!-- Total Pending Borrowed Equipment -->
            <div class="bg-white p-6 rounded-lg shadow-md border border-yellow-100">
                <h3 class="text-lg font-semibold text-yellow-700">Pending Borrow Requests</h3>
                <p class="text-2xl text-yellow-600">{{ $totalPending }}</p>
            </div>

            <!-- Total Sales -->
            <div class="bg-white p-6 rounded-lg shadow-md border border-blue-100">
                <h3 class="text-lg font-semibold text-blue-700">Total Income</h3>
                <p class="text-2xl text-blue-600">{{ number_format($totalSales, 2) }} PHP</p>
            </div>
        </div>

        <!-- Sales Per Equipment Chart -->
        <div class="bg-white p-6 rounded-lg shadow-md border border-gray-100 mt-6">
            <h3 class="text-lg font-semibold text-gray-700">Income Per Equipment</h3>
            <canvas id="salesChart"></canvas>
        </div>

        <!-- Sales Per Equipment Table -->
        <div class="bg-white p-6 rounded-lg shadow-md border border-gray-100 mt-6">
            <h3 class="text-lg font-semibold text-gray-700">Equipment Income</h3>
            <table class="min-w-full table-auto mt-4">
                <thead>
                    <tr>
                        <th class="px-4 py-2 text-left">Equipment Name</th>
                        <th class="px-4 py-2 text-left">Total Income (PHP)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($salesPerEquipment as $sale)
                        <tr>
                            <td class="px-4 py-2">{{ $sale->equipment_name }}</td>
                            <td class="px-4 py-2">{{ number_format($sale->total_sales, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
    // Prepare data for the chart
    const salesData = @json($salesPerEquipment);

    const labels = salesData.map(sale => sale.equipment_name);
    const data = salesData.map(sale => sale.total_sales);

    // Chart.js code
    const ctx = document.getElementById('salesChart').getContext('2d');
    const salesChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Total Income (PHP)',
                data: data,
                backgroundColor: 'rgba(34, 197, 94, 0.5)', // Green color
                borderColor: 'rgba(34, 197, 94, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
</x-adminlayout.app>
