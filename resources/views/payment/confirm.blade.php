<x-app-layout>
    <script src="http://cdn.tailwindcss.com"></script>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-white leading-tight">
            {{ __('Confirm Payment') }}
        </h2>
    </x-slot>

    <div class="py-10 max-w-3xl mx-auto" x-data="{ method: '' }">
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

                <!-- Payment Method Dropdown -->
                <div class="mb-4">
                    <label for="method" class="block mb-2 font-medium">Select Payment Method:</label>
                    <select name="method" id="method" x-model="method" required
                        class=" bg-green-100 hover:bg-green-300 w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <option value="" disabled selected>-- Choose Payment Method --</option>
                        <option value="mpesa">Mpesa</option>
                        <option value="bank">Bank Transfer</option>
                        <option value="paypal">PayPal</option>
                    </select>
                </div>

                <!-- Mpesa Number Input -->
                <div class="mb-4" x-show="method === 'mpesa'" x-cloak>
                    <label for="mpesa_number" class="block mb-1">Mpesa Phone Number</label>
                    <input type="text" name="mpesa_number" placeholder="e.g. 0712345678"
                        class="w-full border px-4 py-2 rounded focus:ring-2 focus:ring-green-500" />
                </div>

                <!-- Bank Account Input -->
                <div class="mb-4" x-show="method === 'bank'" x-cloak>
                    <label for="bank_account" class="block mb-1">Bank Account Number</label>
                    <input type="text" name="bank_account" placeholder="e.g. 010012345678"
                        class="w-full border px-4 py-2 rounded focus:ring-2 focus:ring-blue-500" />
                </div>

                <!-- PayPal Email Input -->
                <div class="mb-4" x-show="method === 'paypal'" x-cloak>
                    <label for="paypal_email" class="block mb-1">PayPal Email</label>
                    <input type="email" name="paypal_email" placeholder="example@email.com"
                        class="w-full border px-4 py-2 rounded focus:ring-2 focus:ring-yellow-500" />
                </div>
                <!--hidden location input-->
                <input type="hidden" name="lat" id="lat">
                <input type="hidden" name="lng" id="lng">
                <p class="text-green-700 font-semibold">
                    Nearest Branch: <span id="nearest-branch-name"></span> -
                    <span id="nearest-branch-location"></span>
                </p>
                <button type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2 rounded shadow">
                    Confirm and Pay
                </button>
            </form>
            @else
            <div class="text-green-600 font-semibold">This order is already paid.</div>
            @endif


            <div class="mt-6 text-semibold rounded py-3 px-4 border-radius">
                <a href="{{ route('customer.orders.index') }}" class="text-blue-600 hover:underline">
                    ← Back to Orders
                </a>
            </div>
        </div>
        <script>
            navigator.geolocation.getCurrentPosition(function(position) {
                    document.getElementById('lat').value = position.coords.latitude;
                    document.getElementById('lng').value = position.coords.longitude;
                    //fetch the nearest branch
                    fetch('/api/nearest-branch?lat=${lat}&lng=${lng}')
                    .then(response =>response.json())
                    .then(data =>{
                        document.getElementById('nearest-branch-name').textContent =data.name;
                        document.getElementById('nearest-branch-location').textContent =data.location;
                    })
                    .catch(err =>consol.error('failed to fetch nearest branch:',err));

                },
                function() {
                    alert("please allow location access for delivery branch.");
                });
        </script>
    </div>
</x-app-layout>