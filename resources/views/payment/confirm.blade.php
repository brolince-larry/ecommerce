{{-- resources/views/payment/confirm.blade.php --}}
<x-app-layout>
    <script src="http://cdn.tailwindcss.com"></script>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-white leading-tight">
            {{ __('Confirm Payment') }}
        </h2>
    </x-slot>

    <div class="py-10 max-w-3xl mx-auto">
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-2xl font-bold mb-4">Confirm Payment</h3>

            <div class="mb-4 space-y-2">
                <p><strong>Order ID:</strong> {{ $order->id }}</p>
                <p><strong>Total Amount:</strong> KSh {{ number_format($order->total, 2) }}</p>
                <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
            </div>

            @if ($order->status !== 'paid')
                <form action="{{ route('payment.pay', $order->id) }}" method="POST">
                    @csrf
                    <button type="submit"
                            class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2 rounded shadow">
                        Confirm and Pay
                    </button>
                </form>
            @else
                <div class="text-green-600 font-semibold">This order is already paid.</div>
            @endif

            <div class="mt-6">
                <a href="{{ route('customer.orders.index') }}" class="text-blue-600 hover:underline">
                    ← Back to Orders
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
