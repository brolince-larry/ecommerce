<x-app-layout>
    <script src="http://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script> <!-- Lucide Icons -->

    <x-slot name="header">
        <h2 class="text-xl font-semibold text-white leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="bg-gray-100 min-h-screen py-10 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto space-y-6">

            <!-- Welcome Banner -->
            <div class="bg-white shadow-sm rounded-lg p-6">
                <h3 class="text-2xl font-bold text-gray-800">Welcome back, {{ Auth::user()->name }} 👋</h3>
                <p class="text-gray-600 mt-1">You're logged in as <strong>Admin</strong>.</p>
            </div>

            <!-- Overview Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-indigo-600 text-white p-6 rounded-lg shadow flex items-center justify-between">
                    <div>
                        <h4 class="text-lg font-semibold">Total Customers</h4>
                        <p class="text-3xl mt-2 font-bold">{{ $totalCustomers }}</p>
                    </div>
                    <i data-lucide="users" class="w-10 h-10"></i>
                </div>
                <div class="bg-green-600 text-white p-6 rounded-lg shadow flex items-center justify-between">
                    <div>
                        <h4 class="text-lg font-semibold">Paid Orders</h4>
                        <p class="text-3xl mt-2 font-bold">{{ $paidOrdersCount }}</p>
                    </div>
                    <i data-lucide="shopping-cart" class="w-10 h-10"></i>
                </div>
                <div class="bg-yellow-500 text-white p-6 rounded-lg shadow flex items-center justify-between">
                    <div>
                        <h4 class="text-lg font-semibold">Categories</h4>
                        <a href="{{ route('categories.index') }}" class="underline text-xl">Manage</a>
                    </div>
                    <i data-lucide="list" class="w-10 h-10"></i>
                </div>
                <div class="bg-purple-600 text-white p-6 rounded-lg shadow flex items-center justify-between">
                    <div>
                        <h4 class="text-lg font-semibold">Users Panel</h4>
                        <a href="{{ route('dashboard') }}" class="underline text-xl">Manage</a>
                    </div>
                    <i data-lucide="settings" class="w-10 h-10"></i>
                </div>
            </div>

            <!-- Management Links -->
            <div class="bg-white shadow-sm rounded-lg p-6 mt-6">
                <h4 class="text-xl font-bold text-gray-800 mb-4">Quick Management</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <a href="{{ route('categories.index') }}" class="bg-indigo-100 hover:bg-indigo-200 p-4 rounded shadow transition flex items-center gap-4">
                        <i data-lucide="folder-plus" class="w-6 h-6 text-indigo-600"></i>
                        <div>
                            <h5 class="text-lg font-semibold text-indigo-700">Manage Categories</h5>
                            <p class="text-sm text-gray-600">Create, edit, or remove product categories.</p>
                        </div>
                    </a>
                    <a href="{{ route('dashboard') }}" class="bg-green-100 hover:bg-green-200 p-4 rounded shadow transition flex items-center gap-4">
                        <i data-lucide="user-cog" class="w-6 h-6 text-green-700"></i>
                        <div>
                            <h5 class="text-lg font-semibold text-green-700">Manage Users</h5>
                            <p class="text-sm text-gray-600">Admin, Seller, Customer account settings.</p>
                        </div>
                    </a>
                    <a href="#" class="bg-yellow-100 hover:bg-yellow-200 p-4 rounded shadow transition flex items-center gap-4">
                        <i data-lucide="wrench" class="w-6 h-6 text-yellow-700"></i>
                        <div>
                            <h5 class="text-lg font-semibold text-yellow-700">Other Management</h5>
                            <p class="text-sm text-gray-600">Placeholder for future features.</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-10 px-4 max-w-7xl mx-auto">
        <div class="bg-white p-4 rounded shadow">
            <h4 class="text-lg font-bold text-gray-800 mb-2 flex items-center gap-2">
                <i data-lucide="bar-chart" class="w-5 h-5"></i> Orders
            </h4>
            <canvas id="ordersBarChart" height="200"></canvas>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <h4 class="text-lg font-bold text-gray-800 mb-2 flex items-center gap-2">
                <i data-lucide="pie-chart" class="w-5 h-5"></i> User Roles
            </h4>
            <canvas id="userPieChart" height="200"></canvas>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <h4 class="text-lg font-bold text-gray-800 mb-2 flex items-center gap-2">
                <i data-lucide="line-chart" class="w-5 h-5"></i> Revenue
            </h4>
            <canvas id="revenueLineChart" height="200"></canvas>
        </div>
    </div>

    <!-- Charts Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        lucide.createIcons(); // Activate Lucide

        const ordersData = {!! json_encode($monthlyOrders->values()) !!};
        const ordersLabels = {!! json_encode($monthlyOrders->keys()) !!};

        const revenueData = {!! json_encode($monthlyRevenue->values()) !!};
        const revenueLabels = {!! json_encode($monthlyRevenue->keys()) !!};

        const roleData = {!! json_encode($userRoleCounts->values()) !!};
        const roleLabels = {!! json_encode($userRoleCounts->keys()) !!};

        // Orders Bar Chart
        new Chart(document.getElementById('ordersBarChart'), {
            type: 'bar',
            data: {
                labels: ordersLabels,
                datasets: [{
                    label: 'Orders',
                    data: ordersData,
                    backgroundColor: 'rgba(59, 130, 246, 0.6)',
                    borderColor: 'rgba(59, 130, 246, 1)',
                    borderWidth: 1
                }]
            },
            options: { responsive: true, scales: { y: { beginAtZero: true } } }
        });

        // Revenue Line Chart
        new Chart(document.getElementById('revenueLineChart'), {
            type: 'line',
            data: {
                labels: revenueLabels,
                datasets: [{
                    label: 'Revenue',
                    data: revenueData,
                    backgroundColor: 'rgba(34, 197, 94, 0.4)',
                    borderColor: 'rgba(34, 197, 94, 1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: { responsive: true, scales: { y: { beginAtZero: true } } }
        });

        // User Roles Pie Chart
        new Chart(document.getElementById('userPieChart'), {
            type: 'pie',
            data: {
                labels: roleLabels,
                datasets: [{
                    label: 'Users',
                    data: roleData,
                    backgroundColor: [
                        'rgba(34,197,94,0.6)',
                        'rgba(99,102,241,0.6)',
                        'rgba(234,179,8,0.6)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'right' },
                    title: { display: true, text: 'User Role Distribution' }
                }
            }
        });
    </script>
</x-app-layout>
