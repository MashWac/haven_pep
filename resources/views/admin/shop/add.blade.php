@extends('layouts.admin')
@section('content')
<main class="flex-1 flex flex-col h-full relative overflow-y-auto bg-background-light dark:bg-background-dark">
    <div class="layout-container flex flex-col w-full max-w-[900px] mx-auto px-6 py-8">
        {{-- Breadcrumbs --}}
        <div class="flex flex-wrap gap-2 mb-6 items-center">
            <a class="text-[#877b64] hover:text-[#DA70D6] text-sm font-medium leading-normal transition-colors" href="{{ url('/admin_dashboard') }}">Home</a>
            <span class="material-symbols-outlined text-[#877b64] text-sm">chevron_right</span>
            <a class="text-[#877b64] hover:text-[#DA70D6] text-sm font-medium leading-normal transition-colors" href="{{ url('/admin_shop') }}">Shop Items</a>
            <span class="material-symbols-outlined text-[#877b64] text-sm">chevron_right</span>
            <span class="text-[#171511] dark:text-white text-sm font-medium">Add New Item</span>
        </div>

        @if(session('success'))
        <div class="mb-6 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-800 dark:text-green-200 px-4 py-3 rounded-lg flex items-center gap-2">
            <span class="material-symbols-outlined">check_circle</span>
            <span>{{ session('success') }}</span>
        </div>
        @endif
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

        <form action="{{ url('/admin_shop/insert') }}" method="POST" enctype="multipart/form-data">
            @csrf
            {{-- Sticky header --}}
            <div class="flex flex-wrap justify-between items-end gap-4 mb-8 sticky top-0 bg-background-light dark:bg-background-dark z-20 py-2 border-b border-transparent">
                <div class="flex flex-col gap-2">
                    <h1 class="text-[#171511] dark:text-white text-3xl font-black">Add New Shop Item</h1>
                    <p class="text-[#877b64] text-base">Fill in the details below to list a new item.</p>
                </div>
                <div class="flex gap-3">
                    <a href="{{ url('/admin_shop') }}" class="flex items-center justify-center px-4 h-10 rounded-lg border border-[#e5e2dc] bg-white dark:bg-[#2c261a] dark:border-[#362f22] dark:text-white text-sm font-medium">Cancel</a>
                    <button type="submit" class="flex items-center justify-center px-4 h-10 rounded-lg bg-[#DA70D6] text-white text-sm font-bold shadow-md hover:opacity-90">
                        <span class="material-symbols-outlined text-[20px] mr-2">save</span>Save Item
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 pb-12">
                {{-- Left: Main Fields --}}
                <div class="lg:col-span-2 flex flex-col gap-6">
                    {{-- Essentials --}}
                    <section class="bg-white dark:bg-[#2c261a] rounded-xl p-6 shadow-sm border border-[#e5e2dc]/50 dark:border-[#362f22]">
                        <h2 class="text-[#171511] dark:text-white text-lg font-bold mb-4 flex items-center gap-2">
                            <span class="material-symbols-outlined text-[#40B5AD]">edit_square</span>
                            Essentials
                        </h2>
                        <div class="flex flex-col gap-4">
                            <label class="flex flex-col gap-2">
                                <span class="text-[#171511] dark:text-[#f8e8c9] text-sm font-medium">Item Name <span class="text-[#DA70D6]">*</span></span>
                                <input name="name" type="text" required value="{{ old('name') }}"
                                    class="form-input w-full rounded-lg border border-[#e5e2dc] bg-background-light dark:bg-[#362f22] dark:border-[#4a402e] dark:text-white h-12 px-4 text-base focus:ring-2 focus:ring-[#DA70D6]/20 focus:border-[#DA70D6] outline-none transition-all placeholder:text-[#877b64]"
                                    placeholder="e.g. Protein Shake – Vanilla">
                            </label>
                            <label class="flex flex-col gap-2">
                                <span class="text-[#171511] dark:text-[#f8e8c9] text-sm font-medium">Category <span class="text-[#DA70D6]">*</span></span>
                                <select name="category_id" required
                                    class="form-select w-full rounded-lg border border-[#e5e2dc] bg-background-light dark:bg-[#362f22] dark:border-[#4a402e] dark:text-white h-12 px-4 text-base focus:ring-2 focus:ring-[#DA70D6]/20 focus:border-[#DA70D6] outline-none transition-all appearance-none">
                                    <option value="" disabled selected>Select a category</option>
                                    @foreach($data['categories'] as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </label>
                        </div>
                    </section>

                    {{-- Description --}}
                    <section class="bg-white dark:bg-[#2c261a] rounded-xl p-6 shadow-sm border border-[#e5e2dc]/50 dark:border-[#362f22]">
                        <h2 class="text-[#171511] dark:text-white text-lg font-bold mb-4 flex items-center gap-2">
                            <span class="material-symbols-outlined text-[#40B5AD]">description</span>
                            Description
                        </h2>
                        <label class="flex flex-col gap-2">
                            <span class="text-[#171511] dark:text-[#f8e8c9] text-sm font-medium">Item Description</span>
                            <div class="w-full rounded-lg border border-[#e5e2dc] dark:border-[#4a402e] overflow-hidden focus-within:ring-2 focus-within:ring-[#DA70D6]/20 focus-within:border-[#DA70D6] transition-all">
                                <textarea name="description" rows="5"
                                    class="w-full p-4 bg-white dark:bg-[#362f22] border-none outline-none resize-none text-[#171511] dark:text-white placeholder:text-[#877b64] text_area_admin"
                                    placeholder="Write a detailed description of this item...">{{ old('description') }}</textarea>
                            </div>
                        </label>
                    </section>
                </div>

                {{-- Right: Image & Pricing --}}
                <div class="flex flex-col gap-6">
                    {{-- Image Upload --}}
                    <section class="bg-white dark:bg-[#2c261a] rounded-xl p-6 shadow-sm border border-[#e5e2dc]/50 dark:border-[#362f22]">
                        <h2 class="text-[#171511] dark:text-white text-lg font-bold mb-4 flex items-center gap-2">
                            <span class="material-symbols-outlined text-[#40B5AD]">add_a_photo</span>
                            Item Image
                        </h2>
                        <div class="flex flex-col items-center justify-center w-full">
                            <div class="mb-4 w-full hidden" id="image-preview-wrapper">
                                <img id="image-preview" src="" alt="Preview" class="w-full h-48 object-cover rounded-lg">
                            </div>
                            <label for="item-image" class="flex flex-col items-center justify-center w-full h-48 border-2 border-[#e5e2dc] border-dashed rounded-lg cursor-pointer bg-background-light dark:bg-[#362f22] dark:border-[#4a402e] hover:bg-primary/30 dark:hover:bg-[#362f22]/50 transition-colors group">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <span class="material-symbols-outlined text-4xl text-[#DA70D6] mb-3 group-hover:scale-110 transition-transform">upload</span>
                                    <p class="mb-2 text-sm text-[#171511] dark:text-white"><span class="font-bold">Click to upload</span> or drag & drop</p>
                                    <p class="text-xs text-[#877b64]">PNG, JPG (MAX. 2MB)</p>
                                </div>
                                <input class="hidden" id="item-image" name="image" type="file" accept="image/png,image/jpeg,image/jpg,image/gif">
                            </label>
                        </div>
                    </section>

                    {{-- Pricing --}}
                    <section class="bg-white dark:bg-[#2c261a] rounded-xl p-6 shadow-sm border border-[#e5e2dc]/50 dark:border-[#362f22]">
                        <h2 class="text-[#171511] dark:text-white text-lg font-bold mb-4 flex items-center gap-2">
                            <span class="material-symbols-outlined text-[#40B5AD]">payments</span>
                            Pricing
                        </h2>
                        <div class="flex flex-col gap-4">
                            <label class="flex flex-col gap-2">
                                <span class="text-[#171511] dark:text-[#f8e8c9] text-sm font-medium">Price (KES) <span class="text-[#DA70D6]">*</span></span>
                                <input name="price" type="number" step="0.01" min="0" required value="{{ old('price') }}"
                                    class="form-input w-full rounded-lg border border-[#e5e2dc] bg-background-light dark:bg-[#362f22] dark:border-[#4a402e] dark:text-white h-11 px-4 text-sm focus:ring-2 focus:ring-[#DA70D6]/20 focus:border-[#DA70D6] outline-none transition-all"
                                    placeholder="e.g. 1500.00">
                            </label>
                            <label class="flex flex-col gap-2">
                                <span class="text-[#171511] dark:text-[#f8e8c9] text-sm font-medium">Discount <span class="text-xs text-[#877b64]">(% optional)</span></span>
                                <input name="discount_percentage" type="number" min="0" max="100" value="{{ old('discount_percentage', 0) }}"
                                    class="form-input w-full rounded-lg border border-[#e5e2dc] bg-background-light dark:bg-[#362f22] dark:border-[#4a402e] dark:text-white h-11 px-4 text-sm focus:ring-2 focus:ring-[#DA70D6]/20 focus:border-[#DA70D6] outline-none transition-all"
                                    placeholder="e.g. 10">
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
    document.getElementById('item-image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(ev) {
                document.getElementById('image-preview').src = ev.target.result;
                document.getElementById('image-preview-wrapper').classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection
