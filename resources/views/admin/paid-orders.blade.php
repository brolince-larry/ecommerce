<x-app-layout>
    <script src="https://cdn.tailwindcss.com"></script>

    <x-slot name="header">
        <h2 class="text-xl font-semibold text-white leading-tight">Paid Orders Summary</h2>
    </x-slot>

    <div class="bg-white p-6 rounded shadow max-w-7xl mx-auto">
        <h3 class="text-2xl font-bold mb-6">All Paid Orders (Last 72 hours)</h3>

        <div id="status-message" class="hidden p-3 mb-4 rounded text-white font-semibold"></div>

        <div class="overflow-x-auto text-sm">
            <table class="min-w-full border border-gray-300">
                <thead>
                    <tr class="bg-green-500 text-white text-left">
                        <th class="p-3 border">Customer</th>
                        <th class="p-3 border">Email</th>
                        <th class="p-3 border">Payment Method</th>
                        <th class="p-3 border">Branch</th>
                        <th class="p-3 border">Products</th>
                        <th class="p-3 border">Amount</th>
                        <th class="p-3 border">Paid At</th>
                        <th class="p-3 border">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                    @php
                        $statuses = ['paid', 'processing', 'ready', 'delivered'];
                        $currentIndex = array_search($order->status, $statuses);
                    @endphp
                    <tr class="border-b bg-green-100 hover:bg-green-200 transition">
                        <td class="p-3">{{ $order->user->name }}</td>
                        <td class="p-3">{{ $order->user->email }}</td>
                        <td class="p-3">
                            @if($order->payments)
                                {{ ucfirst($order->payments->method) }}
                            @else
                                No Payment Info
                            @endif
                        </td>
                        <td class="p-3">
                            {{ $order->branch->name ?? 'N/A' }}
                        </td>
                        <td class="p-3">
                            <ul class="list-disc ml-4 text-sm">
                                @foreach ($order->orderItems as $item)
                                    <li>{{ $item->product->name }} (x{{ $item->quantity }})</li>
                                @endforeach
                            </ul>
                        </td>
                        <td class="p-3 font-semibold">KSh {{ number_format($order->total, 2) }}</td>
                        <td class="p-3 text-red-600 font-semibold">
                            {{ $order->created_at->format('d M Y H:i') }}
                        </td>
                        <td class="p-3">
                            <select
                                name="status"
                                data-order-id="{{ $order->id }}"
                                data-current-status="{{ $order->status }}"
                                class="status-dropdown border rounded px-2 py-1 {{ $order->status === 'delivered' ? 'bg-gray-300 cursor-not-allowed' : 'bg-blue-400 hover:bg-blue-500' }}"
                                {{ $order->status === 'delivered' ? 'disabled' : '' }}>
                                @foreach ($statuses as $i => $status)
                                    @if ($i >= $currentIndex)
                                        <option value="{{ $status }}" {{ $order->status == $status ? 'selected' : '' }}>
                                            {{ ucfirst($status) }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        document.querySelectorAll('.status-dropdown').forEach(select => {
            select.addEventListener('change', function () {
                const orderId = this.getAttribute('data-order-id');
                const newStatus = this.value;
                const currentStatus = this.getAttribute('data-current-status');

                const confirmChange = confirm(`Are you sure you want to change status from "${currentStatus}" to "${newStatus}"?`);
                if (!confirmChange) {
                    this.value = currentStatus;
                    return;
                }

                this.setAttribute('data-current-status', newStatus);
                const statuses = ['paid', 'processing', 'ready', 'delivered'];
                const newIndex = statuses.indexOf(newStatus);

                this.innerHTML = '';
                statuses.slice(newIndex).forEach(status => {
                    const option = document.createElement('option');
                    option.value = status;
                    option.text = status.charAt(0).toUpperCase() + status.slice(1);
                    if (status === newStatus) option.selected = true;
                    this.appendChild(option);
                });

                fetch(`/admin/orders/${orderId}/status`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ status: newStatus })
                })
                .then(res => res.json())
                .then(data => {
                    const messageBox = document.getElementById('status-message');
                    if (data.success) {
                        messageBox.textContent = '✅ Order status updated!';
                        messageBox.className = 'bg-green-500 text-white p-3 mb-4 rounded';
                    } else {
                        messageBox.textContent = '❌ Failed to update status.';
                        messageBox.className = 'bg-red-500 text-white p-3 mb-4 rounded';
                    }
                    messageBox.classList.remove('hidden');
                    setTimeout(() => messageBox.classList.add('hidden'), 4000);
                })
                .catch(error => {
                    console.error('Error:', error);
                    const messageBox = document.getElementById('status-message');
                    messageBox.textContent = '❌ Something went wrong.';
                    messageBox.className = 'bg-red-500 text-white p-3 mb-4 rounded';
                    messageBox.classList.remove('hidden');
                    setTimeout(() => messageBox.classList.add('hidden'), 3000);
                });
            });
        });
    </script>
</x-app-layout>
