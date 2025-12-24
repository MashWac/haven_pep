@extends('layouts.admin')

@section('content')
<main class="flex-1 flex flex-col h-full relative overflow-y-auto bg-background-light dark:bg-background-dark">
    <div class="layout-container flex flex-col w-full max-w-[1200px] mx-auto px-6 py-8">

        <!-- Breadcrumbs -->
        <div class="flex flex-wrap gap-2 mb-6 items-center">
            <a class="text-[#877b64] hover:text-[#DA70D6] text-sm font-medium" href="#">Home</a>
            <span class="material-symbols-outlined text-[#877b64] text-sm">chevron_right</span>
            <a class="text-[#877b64] hover:text-[#DA70D6] text-sm font-medium" href="{{ url('/admin_authors') }}">Authors</a>
            <span class="material-symbols-outlined text-[#877b64] text-sm">chevron_right</span>
            <span class="text-[#171511] dark:text-white text-sm font-medium">Add New</span>
        </div>
        <!-- Success Message -->
        @if(session('success'))
        <div class="mb-6 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-800 dark:text-green-200 px-4 py-3 rounded-lg flex items-center gap-2">
            <span class="material-symbols-outlined">check_circle</span>
            <span>{{ session('success') }}</span>
        </div>
        @endif

        <!-- Error Messages -->
        @if($errors->any())
        <div class="mb-6 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-800 dark:text-red-200 px-4 py-3 rounded-lg">
            <div class="flex items-center gap-2 mb-2">
                <span class="material-symbols-outlined">error</span>
                <span class="font-bold">Please correct the following errors:</span>
            </div>
            <ul class="list-disc list-inside space-y-1">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <!-- FORM START -->
        <form action="{{ url('insert_author') }}" method="POST">
            @csrf

            <!-- Page Header & Actions -->
            <div class="flex flex-wrap justify-between items-end gap-4 mb-8 sticky top-0 bg-background-light dark:bg-background-dark z-20 py-2 border-b border-transparent">
                <div class="flex flex-col gap-2">
                    <h1 class="text-[#171511] dark:text-white text-3xl font-black">Add New Author Category</h1>
                    <p class="text-[#877b64] text-base">Fill in the details to add a new author.</p>
                </div>

                <div class="flex gap-3">
                    <a href="{{ url('/admin_authors') }}"
                        class="flex items-center justify-center px-4 h-10 rounded-lg border border-[#e5e2dc] bg-white dark:bg-[#2c261a] dark:border-[#362f22] dark:text-white text-sm font-medium">
                        Cancel
                    </a>

                    <button type="submit"
                        class="flex items-center justify-center px-4 h-10 rounded-lg bg-[#DA70D6] text-white text-sm font-bold shadow-md hover:opacity-90">
                        <span class="material-symbols-outlined text-[20px] mr-2">publish</span>
                        Add Author
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 pb-12">
                <div class="lg:col-span-2 flex flex-col gap-6">

                    <!-- Essentials -->
                    <section class="bg-white dark:bg-[#2c261a] rounded-xl p-6 shadow-sm border border-[#e5e2dc]/50 dark:border-[#362f22]">
                        <h2 class="text-[#171511] dark:text-white text-lg font-bold mb-4 flex items-center gap-2">
                            <span class="material-symbols-outlined text-[#40B5AD]">edit_square</span>
                            Essentials
                        </h2>

                        <label class="flex flex-col gap-2">
                            <span class="text-[#171511] dark:text-[#f8e8c9] text-sm font-medium">
                                Author Name <span class="text-[#DA70D6]">*</span>
                            </span>

                            <input
                                name="full_name"
                                type="text"
                                value="{{ old('full_name') }}"
                                required
                                class="form-input w-full rounded-lg border border-[#e5e2dc] bg-background-light dark:bg-[#362f22] dark:border-[#4a402e] dark:text-white h-12 px-4 text-base focus:ring-2 focus:ring-[#DA70D6]/20 focus:border-[#DA70D6] outline-none transition-all"
                                placeholder="Enter author name" />
                        </label>
                        <label class="flex flex-col gap-2 mb-4">
                            <span class="text-[#171511] dark:text-[#f8e8c9] text-sm font-medium">Biography</span>
                            <!-- Rich text editor stub -->
                            <div class="w-full rounded-lg border border-[#e5e2dc] bg-background-light dark:bg-[#362f22] dark:border-[#4a402e] overflow-hidden focus-within:ring-2 focus-within:ring-[#DA70D6]/20 focus-within:border-[#DA70D6] transition-all">
                                <textarea name="biography" class="w-full h-32 p-4 bg-transparent border-none outline-none resize-none text-[#171511] dark:text-white placeholder:text-[#877b64] text_area_admin" placeholder="Write a description..."></textarea>
                            </div>
                        </label>
                    </section>

                </div>
                                <div class="flex flex-col gap-6">
                    <!-- Cover Image Upload -->
                    <section class="bg-white dark:bg-[#2c261a] rounded-xl p-6 shadow-sm border border-[#e5e2dc]/50 dark:border-[#362f22]">
                        <h2 class="text-[#171511] dark:text-white text-lg font-bold mb-4 flex items-center gap-2">
                            <span class="material-symbols-outlined text-[#40B5AD]">account_circle</span>
                            Author Image
                        </h2>

                        <div class="flex flex-col items-center justify-center w-full">

                            {{-- Selected Image Preview --}}
                            <div class="mb-4 w-full hidden" id="image-preview-wrapper">
                                <img
                                    id="image-preview"
                                    src=""
                                    alt="Selected Profile Photo"
                                    class="w-full h-48 object-cover rounded-lg">
                                <p class="text-xs text-[#877b64] text-center mt-2">Selected photo</p>
                            </div>

                            {{-- Upload Area --}}
                            <label
                                for="dropzone-file"
                                class="flex flex-col items-center justify-center w-full h-64 border-2 border-[#e5e2dc] border-dashed rounded-lg cursor-pointer bg-background-light dark:bg-[#362f22] dark:border-[#4a402e] hover:bg-primary/30 dark:hover:bg-[#362f22]/50 transition-colors group">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <span class="material-symbols-outlined text-4xl text-[#DA70D6] mb-3 group-hover:scale-110 transition-transform">
                                        add_a_photo
                                    </span>
                                    <p class="mb-2 text-sm text-[#171511] dark:text-white">
                                        <span class="font-bold">Click to upload</span> or drag and drop
                                    </p>
                                    <p class="text-xs text-[#877b64]">PNG, JPG (MAX. 500x500px)</p>
                                </div>

                                <input
                                    class="hidden"
                                    id="dropzone-file"
                                    name="profile_image"
                                    type="file"
                                    accept="image/png,image/jpeg,image/jpg">
                            </label>
                        </div>
                    </section>
                </div>
            </div>
        </form>
        <!-- FORM END -->

    </div>
</main>
@endsection
@section('scripts')
@endsection