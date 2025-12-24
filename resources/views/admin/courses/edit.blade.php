@extends('layouts.admin')
@section('content')
<main class="flex-1 flex flex-col h-full relative overflow-y-auto bg-background-light dark:bg-background-dark">
    <div class="layout-container flex flex-col w-full max-w-[1200px] mx-auto px-6 py-8">
        <div class="flex flex-wrap gap-2 mb-6 items-center">
            <a class="text-[#877b64] hover:text-[#DA70D6] text-sm font-medium leading-normal transition-colors" href="{{ url('/admin_dashboard') }}">Home</a>
            <span class="material-symbols-outlined text-[#877b64] text-sm">chevron_right</span>
            <a class="text-[#877b64] hover:text-[#DA70D6] text-sm font-medium leading-normal transition-colors" href="{{ url('admin_courses') }}">Courses</a>
            <span class="material-symbols-outlined text-[#877b64] text-sm">chevron_right</span>
            <span class="text-[#171511] dark:text-white text-sm font-medium leading-normal">Edit Course</span>
        </div>

        @if(session('success'))
        <div class="mb-6 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-800 dark:text-green-200 px-4 py-3 rounded-lg flex items-center gap-2">
            <span class="material-symbols-outlined">check_circle</span>
            <span>{{ session('success') }}</span>
        </div>
        @endif

        @if($errors->any())
        <div class="mb-6 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-800 dark:text-red-200 px-4 py-3 rounded-lg">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ url('/admin_courses/update/'.$data['course']->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="flex flex-wrap justify-between items-end gap-4 mb-8 sticky top-0 bg-background-light dark:bg-background-dark z-20 py-2 border-b border-transparent">
                <div class="flex flex-col gap-2">
                    <h1 class="text-[#171511] dark:text-white text-3xl font-black">Edit Course</h1>
                    <p class="text-[#877b64] text-base">Modify course details and lesson content.</p>
                </div>

                <div class="flex gap-3">
                    <a href="{{ url('/admin_courses') }}" class="flex items-center justify-center px-4 h-10 rounded-lg border border-[#e5e2dc] bg-white dark:bg-[#2c261a] dark:text-white text-sm font-medium">Cancel</a>
                    <button type="submit" class="flex items-center justify-center px-4 h-10 rounded-lg bg-[#DA70D6] text-white text-sm font-bold shadow-md hover:opacity-90">
                        <span class="material-symbols-outlined text-[20px] mr-2">save</span> Update Course
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 pb-12">
                <div class="lg:col-span-2 flex flex-col gap-6">
                    <section class="bg-white dark:bg-[#2c261a] rounded-xl p-6 shadow-sm border border-[#e5e2dc]/50 dark:border-[#362f22]">
                        <h2 class="text-[#171511] dark:text-white text-lg font-bold mb-4 flex items-center gap-2">
                            <span class="material-symbols-outlined text-[#40B5AD]">edit_square</span> Essentials
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <label class="flex flex-col gap-2">
                                <span class="text-sm font-medium dark:text-[#f8e8c9]">Course Title *</span>
                                <input name="course_name" value="{{ $data['course']->course_name }}" required class="form-input w-full rounded-lg border border-[#e5e2dc] dark:bg-[#362f22] dark:text-white h-12 px-4" />
                            </label>
                            <label class="flex flex-col gap-2">
                                <span class="text-sm font-medium dark:text-[#f8e8c9]">Category</span>
                                <select name="category" class="form-select w-full rounded-lg border border-[#e5e2dc] dark:bg-[#362f22] dark:text-white h-12 px-4">
                                    @foreach($data['course_categories'] as $category)
                                    <option value="{{ $category->id }}" {{ $data['course']->category_id == $category->id ? 'selected' : '' }}>{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                            </label>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <label class="flex flex-col gap-2">
                                <span class="text-sm font-medium dark:text-[#f8e8c9]">Duration *</span>
                                <select name="duration" class="form-select w-full rounded-lg border border-[#e5e2dc] dark:bg-[#362f22] dark:text-white h-12 px-4">
                                    @for($i = 1; $i <= 60; $i++)
                                    <option value="{{ $i }}" {{ $data['course']->course_duration == $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                            </label>
                            <label class="flex flex-col gap-2">
                                <span class="text-sm font-medium dark:text-[#f8e8c9]">Units</span>
                                <select name="duration_units" class="form-select w-full rounded-lg border border-[#e5e2dc] dark:bg-[#362f22] dark:text-white h-12 px-4">
                                    @foreach(['mins', 'hours', 'days', 'weeks', 'months'] as $unit)
                                    <option value="{{ $unit }}" {{ $data['course']->duration_unit == $unit ? 'selected' : '' }}>{{ ucfirst($unit) }}</option>
                                    @endforeach
                                </select>
                            </label>
                        </div>
                    </section>
                                         <!-- Section 2: Details -->

                    <section class="bg-white dark:bg-[#2c261a] rounded-xl p-6 shadow-sm border border-[#e5e2dc]/50 dark:border-[#362f22]">

                        <h2 class="text-[#171511] dark:text-white text-lg font-bold mb-4 flex items-center gap-2">

                            <span class="material-symbols-outlined text-[#40B5AD]">description</span>

                            Details

                        </h2>

                        <label class="flex flex-col gap-2 mb-4">

                            <span class="text-[#171511] dark:text-[#f8e8c9] text-sm font-medium">Description/Synopsis</span>

                            <!-- Rich text editor stub -->

                            <div class="w-full rounded-lg border border-[#e5e2dc] bg-background-light dark:bg-[#362f22] dark:border-[#4a402e] overflow-hidden focus-within:ring-2 focus-within:ring-[#DA70D6]/20 focus-within:border-[#DA70D6] transition-all">

                                <textarea name="description" class="w-full h-32 p-4 bg-transparent border-none outline-none resize-none text-[#171511] dark:text-white placeholder:text-[#877b64] text_area_admin" placeholder="Write a description...">{{ $data['course']->course_description }}</textarea>

                            </div>

                        </label>

                    </section>
                    <section class="bg-white dark:bg-[#2c261a] rounded-xl p-6 shadow-sm border border-[#e5e2dc]/50 dark:border-[#362f22]">
                        <h2 class="text-lg font-bold mb-4 flex items-center gap-2 dark:text-white">
                            <span class="material-symbols-outlined text-[#40B5AD]">description</span> Lesson Curriculum
                        </h2>
                        <label class="flex flex-col gap-2 mb-6">
                            <span class="text-sm font-medium dark:text-[#f8e8c9]">Number of Lessons</span>
                            <select name="no_of_lessons" id="no_of_lessons" class="form-select w-full rounded-lg border border-[#e5e2dc] dark:bg-[#362f22] dark:text-white h-12 px-4">
                                @for($i = 1; $i <= 20; $i++)
                                <option value="{{ $i }}" {{ $data['course']->no_of_lessons == $i ? 'selected' : '' }}>{{ $i }} Lessons</option>
                                @endfor
                            </select>
                        </label>
                        
                        <div id="lesson-material-container" class="space-y-6">
                            </div>
                    </section>
                </div>

                <div class="flex flex-col gap-6">
                    <section class="bg-white dark:bg-[#2c261a] rounded-xl p-6 shadow-sm border border-[#e5e2dc]/50">
                        <h2 class="text-lg font-bold mb-4 dark:text-white flex items-center gap-2">
                            <span class="material-symbols-outlined text-[#40B5AD]">image</span> Cover Image
                        </h2>
                        <div class="flex flex-col items-center">
                            @if($data['course']->cover_image)
                            <img src="{{ $data['course']->cover_image }}" class="w-full h-40 object-cover rounded-lg mb-4 border border-[#e5e2dc]">
                            @endif
                            <input type="file" name="cover_image" class="text-sm dark:text-white">
                        </div>
                    </section>

                    <section class="bg-white dark:bg-[#2c261a] rounded-xl p-6 shadow-sm border border-[#e5e2dc]/50">
                        <h2 class="text-lg font-bold mb-4 dark:text-white flex items-center gap-2">
                            <span class="material-symbols-outlined text-[#40B5AD]">payments</span> Pricing
                        </h2>
                        <div class="space-y-4">
                            <label class="flex items-center gap-2 dark:text-white">
                                <input type="radio" name="access" value="free" {{ $data['course']->pricing == 0 ? 'checked' : '' }}> Free
                            </label>
                            <label class="flex items-center gap-2 dark:text-white">
                                <input type="radio" name="access" value="premium" {{ $data['course']->pricing > 0 ? 'checked' : '' }}> Premium
                            </label>
                            <div id="premium-fields" class="{{ $data['course']->pricing > 0 ? '' : 'hidden' }} space-y-4 pt-2">
                                <input type="number" name="price" value="{{ $data['course']->pricing }}" placeholder="Price" class="w-full rounded-lg border border-[#e5e2dc] dark:bg-[#362f22] p-2 dark:text-white">
                                <input type="number" name="discount" value="{{ $data['course']->discount }}" placeholder="Discount %" class="w-full rounded-lg border border-[#e5e2dc] dark:bg-[#362f22] p-2 dark:text-white">
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
    // Pass existing data from PHP to JS
    const existingLessons = @json($data['lessons'] ?? []);
    const existingMaterials = @json($data['materials'] ?? []);

    document.addEventListener('DOMContentLoaded', function() {
        const lessonSelect = document.getElementById('no_of_lessons');
        const container = document.getElementById('lesson-material-container');
        const premiumFields = document.getElementById('premium-fields');

        // Toggle Pricing
        document.querySelectorAll('input[name="access"]').forEach(radio => {
            radio.addEventListener('change', (e) => {
                premiumFields.classList.toggle('hidden', e.target.value === 'free');
            });
        });

        function generateLessonFields(count) {
            container.innerHTML = '';
            for (let i = 0; i < count; i++) {
                // Try to find existing data for this index
                const lessonData = existingLessons[i] || {};
                
                const html = `
                <div class="p-5 rounded-xl border border-[#e5e2dc] dark:border-[#4a402e] bg-gray-50 dark:bg-[#362f22]/30">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-[#40B5AD] font-bold text-sm uppercase">Lesson ${i + 1}</h3>
                    </div>
                    
                    <div class="grid grid-cols-1 gap-4 mb-4">
                        <input type="text" name="lessons[${i}][title]" value="${lessonData.lesson_title || ''}" 
                            placeholder="Lesson Title" required
                            class="w-full rounded-lg border border-[#e5e2dc] dark:bg-[#362f22] p-3 dark:text-white text-sm">
                        
                        <textarea name="lessons[${i}][description]" placeholder="Short lesson summary..."
                            class="w-full h-20 rounded-lg border border-[#e5e2dc] dark:bg-[#362f22] p-3 dark:text-white text-sm resize-none">${lessonData.description || ''}</textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="flex flex-col gap-1">
                            <span class="text-[10px] font-bold text-[#877b64]">VIDEO CONTENT</span>
                            <input type="file" name="lessons[${i}][video]" accept="video/*" class="text-xs dark:text-white">
                        </div>
                        <div class="flex flex-col gap-1">
                            <span class="text-[10px] font-bold text-[#877b64]">RESOURCES (PPT/PDF)</span>
                            <input type="file" name="lessons[${i}][ppt]" accept=".ppt,.pptx,.pdf" class="text-xs dark:text-white">
                        </div>
                    </div>
                </div>`;
                container.insertAdjacentHTML('beforeend', html);
            }
        }

        lessonSelect.addEventListener('change', (e) => generateLessonFields(e.target.value));
        generateLessonFields(lessonSelect.value);
    });
</script>
@endsection