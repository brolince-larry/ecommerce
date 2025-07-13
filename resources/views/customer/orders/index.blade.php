<x-app-layout>
    <script src="http://cdn.tailwindcss.com"></script>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">Your Orders</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow rounded">
                <div class="max-w-4xl mx-auto mt-6">

                    @if(session('success'))
                        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show"
                            class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <strong class="font-bold">Success!</strong>
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    @auth
                        @if(App\Models\Cart::where('user_id', auth()->id())->exists())
                            <form method="POST" action="{{ route('customer.orders.place') }}">
                                @csrf
                                <button type="submit"
                                        class="mb-4 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-4 py-2 rounded">
                                    + Place New Order
                                </button>
                            </form>
                        @endif
                    @endauth

                    <table class="w-full">
                        <thead>
                            <tr class="bg-green-500">
                                <th class="p-2 text-left">Order #</th>
                                <th class="p-2 text-left">Total</th>
                                <th class="p-2 text-left">Status</th>
                                <th class="p-2 text-left">Date</th>
                                <th class="p-2 text-left">Make Payments</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                                <tr class="bg-green-300 border-t hover:bg-green-350">
                                    <td class="p-2">#{{ $order->id }}</td>
                                    <td class="p-2">KSh {{ number_format($order->total, 2) }}</td>
                                    <td class="p-2 text-sm font-medium text-red-500">{{ ucfirst($order->status) }}</td>
                                    <td class="p-2">{{ $order->created_at->format('d M Y') }}</td>
                                    <td class="p-2">
                                        @if(!$order->is_paid)
                                            <form action="{{ route('payment.confirm', $order->id) }}" method="GET">
                                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded">Pay Now</button>
                                            </form>
                                        @else
                                            <span class="text-green-600 font-semibold">Paid</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="p-4 text-center text-gray-500">No orders found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">{{ $orders->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
