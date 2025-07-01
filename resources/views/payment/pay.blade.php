{{-- resources/views/payment/pay.blade.php --}}
<x-app-layout>
    <script src="http://cdn.tailwindcss.com"></script>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-white leading-tight">
            {{ __('Payment Successful') }}
        </h2>
    </x-slot>

    <div class="py-10 max-w-3xl mx-auto">
        <div class="bg-green-100 border border-green-400 text-green-700 px-6 py-4 rounded-lg shadow">
            <h3 class="text-2xl font-bold mb-2">Payment Confirmed!</h3>
            <p>Your payment for <strong>Order #{{ $order->id }}</strong> has been processed successfully.</p>
            <p>Total Amount: <strong>KSh {{ number_format($order->total, 2) }}</strong></p>
        </div>

        <div class="mt-6 rounded text-white  font-semibold">
            <a href="{{ route('customer.orders.index') }}" class="text-blue-600 hover:underline">
                ← Back to Orders
            </a>
        </div>
    </div>
</x-app-layout>
