@extends('layouts.admin')
@section('content')
<main class="flex-1 flex flex-col h-full relative overflow-y-auto bg-background-light dark:bg-background-dark">
    <div class="layout-container flex flex-col w-full max-w-[1200px] mx-auto px-6 py-8">
        <!-- Breadcrumbs -->
        <div class="flex flex-wrap gap-2 mb-6 items-center">
            <a class="text-[#877b64] hover:text-[#DA70D6] text-sm font-medium leading-normal transition-colors" href="{{ url('/admin_dashboard') }}">Home</a>
            <span class="material-symbols-outlined text-[#877b64] text-sm">chevron_right</span>
            <a class="text-[#877b64] hover:text-[#DA70D6] text-sm font-medium leading-normal transition-colors" href="{{ url('admin_books') }}">Books</a>
            <span class="material-symbols-outlined text-[#877b64] text-sm">chevron_right</span>
            <span class="text-[#171511] dark:text-white text-sm font-medium leading-normal">Edit Book</span>
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
        {{-- Form --}}
        <form action="{{ url('admin_books/update/'.$data['book']->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="flex flex-wrap justify-between items-end gap-4 mb-8 sticky top-0 bg-background-light dark:bg-background-dark z-20 py-2 border-b border-transparent">
                <div class="flex flex-col gap-2">
                    <h1 class="text-[#171511] dark:text-white text-3xl font-black">Edit Book</h1>
                    <p class="text-[#877b64] text-base">Fill in the details to edit book.</p>
                </div>

                <div class="flex gap-3">
                    <a href="{{ url('/admin_books') }}"
                        class="flex items-center justify-center px-4 h-10 rounded-lg border border-[#e5e2dc] bg-white dark:bg-[#2c261a] dark:border-[#362f22] dark:text-white text-sm font-medium">
                        Cancel
                    </a>

                    <button type="submit"
                        class="flex items-center justify-center px-4 h-10 rounded-lg bg-[#DA70D6] text-white text-sm font-bold shadow-md hover:opacity-90">
                        <span class="material-symbols-outlined text-[20px] mr-2">edit</span>
                        Update Book
                    </button>
                </div>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 pb-12">
                <!-- Left Column: Main Form -->
                <div class="lg:col-span-2 flex flex-col gap-6">
                    <!-- Section 1: Essentials -->
                    <section class="bg-white dark:bg-[#2c261a] rounded-xl p-6 shadow-sm border border-[#e5e2dc]/50 dark:border-[#362f22]">
                        <h2 class="text-[#171511] dark:text-white text-lg font-bold mb-4 flex items-center gap-2">
                            <span class="material-symbols-outlined text-[#40B5AD]">edit_square</span>
                            Essentials
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <label class="flex flex-col gap-2">
                                <span class="text-[#171511] dark:text-[#f8e8c9] text-sm font-medium">Book Title <span class="text-[#DA70D6]">*</span></span>
                                <input name="book_name" value="{{$data['book']->title}}" class="form-input w-full rounded-lg border border-[#e5e2dc] bg-background-light dark:bg-[#362f22] dark:border-[#4a402e] dark:text-white h-12 px-4 text-base focus:ring-2 focus:ring-[#DA70D6]/20 focus:border-[#DA70D6] outline-none transition-all placeholder:text-[#877b64]" placeholder="Enter book title" />
                            </label>
                            <label class="flex flex-col gap-2">
                                <span class="text-[#171511] dark:text-[#f8e8c9] text-sm font-medium">Subtitle</span>
                                <input name="sub_title" value="{{$data['book']->subtitle}}" class="form-input w-full rounded-lg border border-[#e5e2dc] bg-background-light dark:bg-[#362f22] dark:border-[#4a402e] dark:text-white h-12 px-4 text-base focus:ring-2 focus:ring-[#DA70D6]/20 focus:border-[#DA70D6] outline-none transition-all placeholder:text-[#877b64]" placeholder="Enter subtitle" />
                            </label>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <label class="flex flex-col gap-2">
                                <span class="text-[#171511] dark:text-[#f8e8c9] text-sm font-medium">
                                    Author Name <span class="text-[#DA70D6]">*</span>
                                </span>

                                <select
                                    name="author_id"
                                    class="author-select w-full select_multiple_options"
                                    required>
                                    <option value="">Select Author</option> 
                                    @foreach ($data['authors'] as $author)
                                    <option value="{{ $author->id }}" {{ $data['book']->author == $author->id ? 'selected' : '' }}>
                                        {{ $author->full_name }}
                                    </option>
                                    @endforeach
                                </select>
                            </label>

                            <label class="flex flex-col gap-2">
                                <span class="text-[#171511] dark:text-[#f8e8c9] text-sm font-medium">ISBN</span>
                                <input name="isbn" value="{{$data['book']->isbn}}" class="form-input w-full rounded-lg border border-[#e5e2dc] bg-background-light dark:bg-[#362f22] dark:border-[#4a402e] dark:text-white h-12 px-4 text-base focus:ring-2 focus:ring-[#DA70D6]/20 focus:border-[#DA70D6] outline-none transition-all placeholder:text-[#877b64]" placeholder="e.g. Penguin Books" />
                            </label>
                        </div>
                    </section>
                    <!-- Section 2: Details -->
                    <section class="bg-white dark:bg-[#2c261a] rounded-xl p-6 shadow-sm border border-[#e5e2dc]/50 dark:border-[#362f22]">
                        <h2 class="text-[#171511] dark:text-white text-lg font-bold mb-4 flex items-center gap-2">
                            <span class="material-symbols-outlined text-[#40B5AD]">description</span>
                            Details
                        </h2>
                        <label class="flex flex-col gap-2 mb-6">
                            <div class="w-full rounded-lg border border-[#e5e2dc] bg-background-light dark:bg-[#362f22] dark:border-[#4a402e] overflow-hidden focus-within:ring-2 focus-within:ring-[#DA70D6]/20 focus-within:border-[#DA70D6] transition-all">
                                <textarea name="description" class="w-full h-32 p-4 bg-transparent border-none outline-none resize-none text-[#171511] dark:text-white placeholder:text-[#877b64] text_area_admin" placeholder="Share your professional journey and philosophy...">{{ old('bio', $data['book']->synopsis) }}</textarea>
                            </div>
                        </label>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <label class="flex flex-col gap-2">
                                <span class="text-[#171511] dark:text-[#f8e8c9] text-sm font-medium">Category</span>
                                <div class="relative">
                                    <select name="category" class="form-select w-full rounded-lg border border-[#e5e2dc] bg-background-light dark:bg-[#362f22] dark:border-[#4a402e] dark:text-white h-12 px-4 text-base focus:ring-2 focus:ring-[#DA70D6]/20 focus:border-[#DA70D6] outline-none transition-all appearance-none">
                                        <option value="">Select category</option>
                                        @foreach($data['book_categories'] as $category)
                                        <option value="{{ $category->id }}" {{ $data['book']->category_id == $category->id ? 'selected' : '' }}>{{ $category->category_name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="material-symbols-outlined absolute right-4 top-3 text-[#877b64] pointer-events-none">expand_more</span>
                                </div>
                            </label>
                        </div>
                    </section>
                </div>
                <!-- Right Column: Visuals & Uploads -->
                <div class="flex flex-col gap-6">
                    <!-- Cover Image Upload -->
                    <section class="bg-white dark:bg-[#2c261a] rounded-xl p-6 shadow-sm border border-[#e5e2dc]/50 dark:border-[#362f22]">
                        <h2 class="text-[#171511] dark:text-white text-lg font-bold mb-4 flex items-center gap-2">
                            <span class="material-symbols-outlined text-[#40B5AD]">account_circle</span>
                            Cover Image
                        </h2>

                        <div class="flex flex-col items-center justify-center w-full">
                            {{-- Current Image --}}
                            @if($data['book']->image)
                            <div class="mb-4 w-full" id="current-image">
                                <img
                                    src="{{ asset($data['book']->image) }}"
                                    alt="Current Profile Photo"
                                    class="w-full h-48 object-cover rounded-lg">
                                <p class="text-xs text-[#877b64] text-center mt-2">Current photo</p>
                            </div>
                            @endif
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
                                    name="cover_image"
                                    type="file"
                                    accept="image/png,image/jpeg,image/jpg">
                            </label>
                        </div>
                    </section>
                    <!-- File Upload -->
                    <section class="bg-white dark:bg-[#2c261a] rounded-xl p-6 shadow-sm border border-[#e5e2dc]/50 dark:border-[#362f22]">
                        <h2 class="text-[#171511] dark:text-white text-lg font-bold mb-4 flex items-center gap-2">
                            <span class="material-symbols-outlined text-[#40B5AD]">attachment</span>
                            Book File
                        </h2>
                        <div class="flex flex-col gap-3">
                            <label class="cursor-pointer p-4 rounded-lg bg-background-light dark:bg-[#362f22] border border-[#e5e2dc] dark:border-[#4a402e] flex items-center justify-between hover:border-[#40B5AD] transition-colors">
                                <div class="flex items-center gap-3">
                                    <span class="material-symbols-outlined text-[#40B5AD]">picture_as_pdf</span>
                                    <div class="flex flex-col">
                                        <span id="file-name" class="text-sm font-medium text-[#171511] dark:text-white">Upload PDF/EPUB</span>
                                        <span id="file-size-info" class="text-xs text-[#877b64]">Max 50MB</span>
                                    </div>
                                </div>

                                <input type="file" id="book-upload" name='book_file' class="hidden" accept=".pdf,.epub" />

                                <span class="text-[#DA70D6] text-sm font-bold hover:underline">Browse</span>
                            </label>
                        </div>
                    </section>
                    <!-- Access & Price -->
                    <section class="bg-white dark:bg-[#2c261a] rounded-xl p-6 shadow-sm border border-[#e5e2dc]/50 dark:border-[#362f22]">
                        <h2 class="text-[#171511] dark:text-white text-lg font-bold mb-4 flex items-center gap-2">
                            <span class="material-symbols-outlined text-[#40B5AD]">lock_open</span>
                            Access
                        </h2>

                        <div class="flex flex-col gap-3">
                            {{-- Free Access --}}
                            <label class="flex items-center gap-3 p-3 rounded-lg border border-[#e5e2dc] dark:border-[#4a402e] cursor-pointer hover:bg-background-light dark:hover:bg-[#362f22] transition-colors has-[:checked]:border-[#DA70D6] has-[:checked]:bg-[#DA70D6]/5">
                                <input
                                    class="w-4 h-4 text-[#DA70D6] border-gray-300 focus:ring-[#DA70D6]"
                                    name="access"
                                    type="radio"
                                    value="free"
                                    {{  $data['book']->pricing == 0 ? 'checked' : '' }}>
                                <div class="flex flex-col">
                                    <span class="text-sm font-medium text-[#171511] dark:text-white">Free Access</span>
                                    <span class="text-xs text-[#877b64]">Available to all users</span>
                                </div>
                            </label>

                            {{-- Premium Access --}}
                            <label class="flex items-center gap-3 p-3 rounded-lg border border-[#e5e2dc] dark:border-[#4a402e] cursor-pointer hover:bg-background-light dark:hover:bg-[#362f22] transition-colors has-[:checked]:border-[#DA70D6] has-[:checked]:bg-[#DA70D6]/5">
                                <input
                                    class="w-4 h-4 text-[#DA70D6] border-gray-300 focus:ring-[#DA70D6]"
                                    name="access"
                                    type="radio"
                                    value="premium"
                                    {{ old('access', $data['book']->pricing) != 0 ? 'checked' : '' }}>
                                <div class="flex flex-col">
                                    <span class="text-sm font-medium text-[#171511] dark:text-white">Premium Only</span>
                                    <span class="text-xs text-[#877b64]">Subscribers only</span>
                                </div>
                            </label>

                            {{-- PREMIUM FIELDS: Visible if current state is premium or validation failed for premium --}}
                            <div id="premium-fields" class="{{ old('access', $data['book']->access) === 'premium' ? '' : 'hidden' }} mt-4 space-y-4">
                                {{-- Price --}}
                                <label class="flex flex-col gap-2">
                                    <span class="text-sm font-medium text-[#171511] dark:text-white">Price</span>
                                    <input
                                        type="number"
                                        step="0.01"
                                        name="price"
                                        value="{{ old('price', $data['book']->pricing) }}"
                                        class="form-input w-full rounded-lg border {{ $errors->has('price') ? 'border-red-500' : 'border-[#e5e2dc]' }} bg-background-light dark:bg-[#362f22] dark:border-[#4a402e] dark:text-white h-11 px-4 text-sm focus:ring-2 focus:ring-[#DA70D6]/20 focus:border-[#DA70D6]"
                                        placeholder="e.g. 9.99">
                                    @error('price') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                                </label>

                                {{-- Discount --}}
                                <label class="flex flex-col gap-2">
                                    <span class="text-sm font-medium text-[#171511] dark:text-white">Discount (%)</span>
                                    <input
                                        type="number"
                                        name="discount"
                                        value="{{ old('discount', $data['book']->discount) }}"
                                        class="form-input w-full rounded-lg border border-[#e5e2dc] bg-background-light dark:bg-[#362f22] dark:border-[#4a402e] dark:text-white h-11 px-4 text-sm focus:ring-2 focus:ring-[#DA70D6]/20 focus:border-[#DA70D6]"
                                        placeholder="e.g. 20">
                                </label>
                            </div>
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
document.addEventListener('DOMContentLoaded', function() {
    const accessRadios = document.querySelectorAll('input[name="access"]');
    const premiumFields = document.getElementById('premium-fields');

    // 1. Define the toggle function
    function togglePremiumFields() {
        // Find the radio button that is currently checked
        const checkedRadio = document.querySelector('input[name="access"]:checked');
        
        if (checkedRadio && checkedRadio.value === 'premium') {
            premiumFields.classList.remove('hidden');
        } else {
            premiumFields.classList.add('hidden');
        }
    }

    // 2. Run immediately on page load/reload
    togglePremiumFields();

    // 3. Attach event listeners for future changes
    accessRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            togglePremiumFields();

            // Clear values ONLY on manual change to 'free', 
            // not on initial page load (to preserve old input)
            if (this.value === 'free') {
                premiumFields.querySelectorAll('input').forEach(input => {
                    input.value = '';
                });
            }
        });
    });
});
</script>
<script>
    const fileInput = document.getElementById('book-upload');
    const fileNameDisplay = document.getElementById('file-name');
    const fileSizeDisplay = document.getElementById('file-size-info');

    fileInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            const file = this.files[0];
            const fileSizeMB = (file.size / (1024 * 1024)).toFixed(2);

            // Check if file is too large
            if (fileSizeMB > 50) {
                alert("File is too large! Maximum 50MB allowed.");
                this.value = ""; // Reset input
                return;
            }

            // Update UI to show the selected file
            fileNameDisplay.textContent = file.name;
            fileSizeDisplay.textContent = `${fileSizeMB} MB`;
            fileSizeDisplay.classList.add('text-[#40B5AD]'); // Visual feedback
        }
    });
</script>
@endsection