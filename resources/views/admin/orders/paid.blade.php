<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-white leading-tight">Paid Orders</h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto px-4">
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-2xl font-bold mb-4">All Paid Orders</h3>

            <table class="w-full table-auto">
                <thead>
                    <tr class="bg-gray-100 bg-green-500">
                        <th class="p-2 text-left">Order #</th>
                        <th class="p-2 text-left">Customer</th>
                        <th class="p-2 text-left">Amount</th>
                        <th class="p-2 text-left">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr class="border-b hover:bg-gray-50 bg-green-300">
                            <td class="p-2">#{{ $order->id }}</td>
                            <td class="p-2">{{ $order->user->name }} ({{ $order->user->email }})</td>
                            <td class="p-2">KSh {{ number_format($order->total, 2) }}</td>
                            <td class="p-2">{{ $order->created_at->format('d M Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
