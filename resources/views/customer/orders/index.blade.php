<x-app-layout>
    <script src="http://cdn.tailwindcss.com"></script>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">Your Orders</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow rounded">

                @if(session('success'))
                    <div class="mb-4 text-green-600">{{ session('success') }}</div>
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
                        <tr class="bg-gray-100">
                            <th class="p-2 text-left">Order #</th>
                            <th class="p-2 text-left">Total</th>
                            <th class="p-2 text-left">Status</th>
                            <th class="p-2 text-left">Date</th>
                            <th class="p-2 text-left">Make Payments</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                            <tr class="border-t hover:bg-gray-50">
                                <td class="p-2">#{{ $order->id }}</td>
                                <td class="p-2">KSh {{ number_format($order->total, 2) }}</td>
                                <td class="p-2 capitalize">{{ $order->status }}</td>
                                <td class="p-2">{{ $order->created_at->format('d M Y') }}</td>
                                <td>
                                    @if($order->status !== 'paid')
                                    <form action="{{route('payment.confirm', $order->id)}}" method="GET">
                                    
                                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white px-4 py-2 rounded">Pay Now</button>
                                    </form>
                                    
@else
    <span class="text-green-600 font-semibold">Paid</span>
                                    @endif

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="p-4 text-center text-gray-500">No orders found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4">{{ $orders->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>
