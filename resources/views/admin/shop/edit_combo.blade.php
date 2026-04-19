@extends('layouts.admin')
@section('content')
<main class="flex-1 flex flex-col h-full relative overflow-y-auto bg-background-light dark:bg-background-dark">
    <div class="layout-container flex flex-col w-full max-w-[900px] mx-auto px-6 py-8">
        {{-- Breadcrumbs --}}
        <div class="flex flex-wrap gap-2 mb-6 items-center">
            <a class="text-[#877b64] hover:text-[#DA70D6] text-sm font-medium transition-colors" href="{{ url('/admin_dashboard') }}">Home</a>
            <span class="material-symbols-outlined text-[#877b64] text-sm">chevron_right</span>
            <a class="text-[#877b64] hover:text-[#DA70D6] text-sm font-medium transition-colors" href="{{ url('/admin_shop_combos') }}">Combos</a>
            <span class="material-symbols-outlined text-[#877b64] text-sm">chevron_right</span>
            <span class="text-[#171511] dark:text-white text-sm font-medium">Edit Combo</span>
        </div>

        @if($errors->any())
        <div class="mb-6 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-800 dark:text-red-200 px-4 py-3 rounded-lg">
            <div class="flex items-center gap-2 mb-2">
                <span class="material-symbols-outlined">error</span>
                <span class="font-bold">Please fix the following errors:</span>
            </div>
            <ul class="list-disc list-inside space-y-1">
                @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
        @endif

        <form action="{{ url('/admin_shop_combos/update/'.$data['combo']->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            {{-- Sticky Header --}}
            <div class="flex flex-wrap justify-between items-end gap-4 mb-8 sticky top-0 bg-background-light dark:bg-background-dark z-20 py-2 border-b border-transparent">
                <div class="flex flex-col gap-2">
                    <h1 class="text-[#171511] dark:text-white text-3xl font-black">Edit Combo</h1>
                    <p class="text-[#877b64] text-base">Updating: {{ $data['combo']->name }}</p>
                </div>
                <div class="flex gap-3">
                    <a href="{{ url('/admin_shop_combos') }}" class="flex items-center justify-center px-4 h-10 rounded-lg border border-[#e5e2dc] bg-white dark:bg-[#2c261a] dark:border-[#362f22] dark:text-white text-sm font-medium">Cancel</a>
                    <button type="submit" class="flex items-center justify-center px-4 h-10 rounded-lg bg-[#DA70D6] text-white text-sm font-bold shadow-md hover:opacity-90">
                        <span class="material-symbols-outlined text-[20px] mr-2">save</span>Update Combo
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 pb-12">
                {{-- Left: Main Fields --}}
                <div class="lg:col-span-2 flex flex-col gap-6">
                    <section class="bg-white dark:bg-[#2c261a] rounded-xl p-6 shadow-sm border border-[#e5e2dc]/50 dark:border-[#362f22]">
                        <h2 class="text-[#171511] dark:text-white text-lg font-bold mb-4 flex items-center gap-2">
                            <span class="material-symbols-outlined text-[#40B5AD]">edit_square</span>Essentials
                        </h2>
                        <div class="flex flex-col gap-4">
                            <label class="flex flex-col gap-2">
                                <span class="text-[#171511] dark:text-[#f8e8c9] text-sm font-medium">Combo Name <span class="text-[#DA70D6]">*</span></span>
                                <input name="name" type="text" required value="{{ old('name', $data['combo']->name) }}"
                                    class="form-input w-full rounded-lg border border-[#e5e2dc] bg-background-light dark:bg-[#362f22] dark:border-[#4a402e] dark:text-white h-12 px-4 text-base focus:ring-2 focus:ring-[#DA70D6]/20 focus:border-[#DA70D6] outline-none transition-all">
                            </label>
                            <label class="flex flex-col gap-2">
                                <span class="text-[#171511] dark:text-[#f8e8c9] text-sm font-medium">Description</span>
                                <div class="w-full rounded-lg border border-[#e5e2dc] dark:border-[#4a402e] overflow-hidden focus-within:ring-2 focus-within:ring-[#DA70D6]/20 transition-all">
                                    <textarea name="description" rows="4"
                                        class="w-full p-4 bg-white dark:bg-[#362f22] border-none outline-none resize-none text-[#171511] dark:text-white placeholder:text-[#877b64] text_area_admin"
                                        placeholder="Describe this combo deal...">{{ old('description', $data['combo']->description) }}</textarea>
                                </div>
                            </label>
                        </div>
                    </section>

                    {{-- Items Included --}}
                    <section class="bg-white dark:bg-[#2c261a] rounded-xl p-6 shadow-sm border border-[#e5e2dc]/50 dark:border-[#362f22]">
                        <h2 class="text-[#171511] dark:text-white text-lg font-bold mb-1 flex items-center gap-2">
                            <span class="material-symbols-outlined text-[#40B5AD]">inventory_2</span>Items Included
                        </h2>
                        <p class="text-xs text-[#877b64] mb-4">Select all shop items to include in this combo.</p>

                        @if($data['items']->isEmpty())
                            <div class="text-sm text-gray-400 py-4">No shop items available.</div>
                        @else
                        {{-- Search filter --}}
                        <div class="mb-4 relative">
                            <span class="material-symbols-outlined absolute left-3 top-2.5 text-gray-400 text-lg pointer-events-none">search</span>
                            <input type="text" id="item-search" placeholder="Search items..."
                                class="w-full pl-9 pr-4 h-10 rounded-lg border border-[#e5e2dc] dark:border-[#4a402e] bg-background-light dark:bg-[#362f22] dark:text-white text-sm focus:ring-2 focus:ring-[#DA70D6]/20 focus:border-[#DA70D6] outline-none transition-all">
                        </div>
                        <div class="flex flex-col gap-2 max-h-64 overflow-y-auto pr-1 item-list">
                            @php $selectedItems = old('items_included', $data['selected_items']); @endphp
                            @foreach($data['items'] as $item)
                            <label id="item-row-{{ $item->id }}" class="flex items-center gap-3 p-3 rounded-lg border border-[#e5e2dc] dark:border-[#4a402e] cursor-pointer hover:bg-[#DA70D6]/5 transition-colors has-[:checked]:border-[#DA70D6] has-[:checked]:bg-[#DA70D6]/5">
                                <input type="checkbox" name="items_included[]" value="{{ $item->id }}"
                                    {{ is_array($selectedItems) && in_array($item->id, $selectedItems) ? 'checked' : '' }}
                                    class="w-4 h-4 text-[#DA70D6] rounded border-gray-300 focus:ring-[#DA70D6]">
                                <div class="flex-1 min-w-0">
                                    <span class="item-name font-medium text-sm text-[#171511] dark:text-white">{{ $item->name }}</span>
                                    <span class="text-xs text-gray-400 ml-2">{{ $item->category_name }}</span>
                                </div>
                                <span class="text-sm font-semibold text-[#DA70D6] shrink-0">KES {{ number_format($item->price, 2) }}</span>
                            </label>
                            @endforeach
                        </div>
                        <p id="no-results" class="hidden text-sm text-gray-400 text-center py-4">No items match your search.</p>
                        @endif
                    </section>
                </div>

                {{-- Right: Image & Pricing --}}
                <div class="flex flex-col gap-6">
                    {{-- Image --}}
                    <section class="bg-white dark:bg-[#2c261a] rounded-xl p-6 shadow-sm border border-[#e5e2dc]/50 dark:border-[#362f22]">
                        <h2 class="text-[#171511] dark:text-white text-lg font-bold mb-4 flex items-center gap-2">
                            <span class="material-symbols-outlined text-[#40B5AD]">add_a_photo</span>Combo Image
                        </h2>
                        @if($data['combo']->image)
                        <div class="mb-3">
                            <img src="{{ asset($data['combo']->image) }}" alt="{{ $data['combo']->name }}" class="w-full h-36 object-cover rounded-lg border border-[#e5e2dc] dark:border-[#4a402e]">
                            <p class="text-xs text-[#877b64] text-center mt-1">Current image</p>
                        </div>
                        @endif
                        <div id="image-preview-wrapper" class="hidden mb-3">
                            <img id="image-preview" src="" alt="New Preview" class="w-full h-36 object-cover rounded-lg">
                            <p class="text-xs text-[#877b64] text-center mt-1">New image preview</p>
                        </div>
                        <label for="combo-image" class="flex flex-col items-center justify-center w-full h-32 border-2 border-[#e5e2dc] border-dashed rounded-lg cursor-pointer bg-background-light dark:bg-[#362f22] dark:border-[#4a402e] hover:bg-primary/30 transition-colors group">
                            <span class="material-symbols-outlined text-3xl text-[#DA70D6] group-hover:scale-110 transition-transform">upload</span>
                            <p class="text-xs text-center mt-1 text-[#877b64]">Click to replace image</p>
                            <input class="hidden" id="combo-image" name="image" type="file" accept="image/png,image/jpeg,image/jpg,image/gif">
                        </label>
                    </section>

                    {{-- Pricing --}}
                    <section class="bg-white dark:bg-[#2c261a] rounded-xl p-6 shadow-sm border border-[#e5e2dc]/50 dark:border-[#362f22]">
                        <h2 class="text-[#171511] dark:text-white text-lg font-bold mb-4 flex items-center gap-2">
                            <span class="material-symbols-outlined text-[#40B5AD]">payments</span>Pricing
                        </h2>
                        <div class="flex flex-col gap-4">
                            <label class="flex flex-col gap-2">
                                <span class="text-[#171511] dark:text-[#f8e8c9] text-sm font-medium">Combo Price (KES) <span class="text-[#DA70D6]">*</span></span>
                                <input name="price" type="number" step="0.01" min="0" required value="{{ old('price', $data['combo']->price) }}"
                                    class="form-input w-full rounded-lg border border-[#e5e2dc] bg-background-light dark:bg-[#362f22] dark:border-[#4a402e] dark:text-white h-11 px-4 text-sm focus:ring-2 focus:ring-[#DA70D6]/20 focus:border-[#DA70D6] outline-none transition-all">
                            </label>
                            <label class="flex flex-col gap-2">
                                <span class="text-[#171511] dark:text-[#f8e8c9] text-sm font-medium">Discount <span class="text-xs text-[#877b64]">(% optional)</span></span>
                                <input name="discount_percentage" type="number" min="0" max="100" value="{{ old('discount_percentage', $data['combo']->discount_percentage) }}"
                                    class="form-input w-full rounded-lg border border-[#e5e2dc] bg-background-light dark:bg-[#362f22] dark:border-[#4a402e] dark:text-white h-11 px-4 text-sm focus:ring-2 focus:ring-[#DA70D6]/20 focus:border-[#DA70D6] outline-none transition-all">
                            </label>
                        </div>
                    </section>
                </div>
            </div>
        </form>
    </div>
</main>
@endsection
@section('scripts')
<script>
    document.getElementById('combo-image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = ev => {
                document.getElementById('image-preview').src = ev.target.result;
                document.getElementById('image-preview-wrapper').classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }
    });

    document.getElementById('item-search').addEventListener('input', function() {
        const query = this.value.toLowerCase();
        const rows = document.querySelectorAll('.item-list label');
        let visible = 0;
        rows.forEach(row => {
            const name = row.querySelector('.item-name').textContent.toLowerCase();
            const match = name.includes(query);
            row.style.display = match ? '' : 'none';
            if (match) visible++;
        });
        document.getElementById('no-results').classList.toggle('hidden', visible > 0);
    });
</script>
@endsection
