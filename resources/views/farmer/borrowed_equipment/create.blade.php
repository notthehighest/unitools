<x-farmerlayout.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Borrow Equipment') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Borrow Equipment</h1>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <form action="{{ route('farmer.borrowed_equipment.store') }}" method="POST">
            @csrf

            <div class="form-group mb-4">
                <label for="equipment_id" class="block text-sm font-medium text-gray-700">Equipment</label>
                <select name="equipment_id" id="equipment_id" class="form-control mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-200" required onchange="updatePrice()">
                    <option value="">-- Select Equipment --</option>
                    @foreach($equipment as $item)
                        <option value="{{ $item->id }}" data-price="{{ $item->price }}">{{ $item->name }}</option>
                    @endforeach
                </select>
                @error('equipment_id')
                    <div class="text-red-600 mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-4">
                <label for="price" class="block text-sm font-medium text-gray-700">Price:</label>
                <div id="price-display" class="text-lg font-semibold text-gray-800"></div>
            </div>

            <div class="form-group mb-4">
                <label for="borrowed_date" class="block text-sm font-medium text-gray-700">Borrowed Date</label>
                <input type="date" name="borrowed_date" id="borrowed_date" class="form-control mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-200" required>
                @error('borrowed_date')
                    <div class="text-red-600 mt-1">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition duration-200">Borrow</button>
            <a href="{{ route('farmer.borrowed_equipment.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700 transition duration-200">Cancel</a>
        </form>

        <script>
            function updatePrice() {
                const select = document.getElementById('equipment_id');
                const priceDisplay = document.getElementById('price-display');
                const selectedOption = select.options[select.selectedIndex];

                if (selectedOption.value) {
                    const price = selectedOption.getAttribute('data-price');
                    priceDisplay.textContent = `Php ${parseFloat(price).toFixed(2)}`;
                } else {
                    priceDisplay.textContent = '';
                }
            }
        </script>
    </div>
</x-farmerlayout.app>