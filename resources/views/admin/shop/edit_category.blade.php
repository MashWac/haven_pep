@extends('layouts.admin')
@section('content')
<main class="flex-1 flex flex-col h-full relative overflow-y-auto bg-background-light dark:bg-background-dark">
    <div class="layout-container flex flex-col w-full max-w-[600px] mx-auto px-6 py-8">
        <div class="flex flex-wrap gap-2 mb-6 items-center">
            <a class="text-[#877b64] hover:text-[#DA70D6] text-sm font-medium transition-colors" href="{{ url('/admin_dashboard') }}">Home</a>
            <span class="material-symbols-outlined text-[#877b64] text-sm">chevron_right</span>
            <a class="text-[#877b64] hover:text-[#DA70D6] text-sm font-medium transition-colors" href="{{ url('/admin_shop_categories') }}">Categories</a>
            <span class="material-symbols-outlined text-[#877b64] text-sm">chevron_right</span>
            <span class="text-[#171511] dark:text-white text-sm font-medium">Edit Category</span>
        </div>

        @if($errors->any())
        <div class="mb-6 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-800 dark:text-red-200 px-4 py-3 rounded-lg">
            <ul class="list-disc list-inside space-y-1">
                @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
        @endif

        <div class="bg-white dark:bg-[#2c261a] rounded-xl p-8 shadow-sm border border-[#e5e2dc]/50 dark:border-[#362f22]">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 rounded-lg bg-[#40B5AD]/10 flex items-center justify-center">
                    <span class="material-symbols-outlined text-[#40B5AD]">edit</span>
                </div>
                <div>
                    <h1 class="text-[#171511] dark:text-white text-2xl font-black">Edit Category</h1>
                    <p class="text-[#877b64] text-sm">Updating: {{ $data['category']->name }}</p>
                </div>
            </div>

            <form action="{{ url('/admin_shop_categories/update/'.$data['category']->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="flex flex-col gap-5">
                    <label class="flex flex-col gap-2">
                        <span class="text-[#171511] dark:text-[#f8e8c9] text-sm font-medium">Category Name <span class="text-[#DA70D6]">*</span></span>
                        <input name="name" type="text" required value="{{ old('name', $data['category']->name) }}"
                            class="form-input w-full rounded-lg border border-[#e5e2dc] bg-background-light dark:bg-[#362f22] dark:border-[#4a402e] dark:text-white h-12 px-4 text-base focus:ring-2 focus:ring-[#DA70D6]/20 focus:border-[#DA70D6] outline-none transition-all">
                    </label>

                    <label class="flex flex-col gap-2">
                        <span class="text-[#171511] dark:text-[#f8e8c9] text-sm font-medium">Description <span class="text-xs text-[#877b64]">(optional)</span></span>
                        <textarea name="description" rows="4"
                            class="w-full rounded-lg border border-[#e5e2dc] bg-background-light dark:bg-[#362f22] dark:border-[#4a402e] dark:text-white p-4 text-base focus:ring-2 focus:ring-[#DA70D6]/20 focus:border-[#DA70D6] outline-none transition-all resize-none">{{ old('description', $data['category']->description) }}</textarea>
                    </label>

                    <div class="flex justify-end gap-3 mt-2">
                        <a href="{{ url('/admin_shop_categories') }}" class="flex items-center justify-center px-5 h-10 rounded-lg border border-[#e5e2dc] bg-white dark:bg-[#2c261a] dark:border-[#362f22] dark:text-white text-sm font-medium">Cancel</a>
                        <button type="submit" class="flex items-center justify-center px-5 h-10 rounded-lg bg-[#DA70D6] text-white text-sm font-bold shadow-md hover:opacity-90 transition-opacity">
                            <span class="material-symbols-outlined text-[18px] mr-1">save</span>
                            Update Category
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection
@section('scripts')
@endsection
