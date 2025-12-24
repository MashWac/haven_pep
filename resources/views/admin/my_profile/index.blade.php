@extends('layouts.admin')
@section('content')
<main class="flex-1 flex flex-col h-full relative overflow-y-auto bg-background-light dark:bg-background-dark">
    <div class="layout-container flex flex-col w-full max-w-[1200px] mx-auto px-6 py-8">
        <div class="flex flex-wrap gap-2 mb-6 items-center">
            <a class="text-[#877b64] hover:text-[#DA70D6] text-sm font-medium leading-normal transition-colors" href="{{ url('')}}">Home</a>
            <span class="material-symbols-outlined text-[#877b64] text-sm">chevron_right</span>
            <a class="text-[#877b64] hover:text-[#DA70D6] text-sm font-medium leading-normal transition-colors" href="{{ url('') }}">Instructors</a>
            <span class="material-symbols-outlined text-[#877b64] text-sm">chevron_right</span>
            <span class="text-[#171511] dark:text-white text-sm font-medium leading-normal">Update Profile</span>
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

        <form action="{{ url('update_instructor_profile/'.$data['instructor']->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="flex flex-wrap justify-between items-end gap-4 mb-8 sticky top-0 bg-background-light dark:bg-background-dark z-20 py-2 border-b border-transparent">
                <div class="flex flex-col gap-2">
                    <h1 class="text-[#171511] dark:text-white text-3xl font-black leading-tight tracking-tight">Update Instructor Profile</h1>
                    <p class="text-[#877b64] text-base font-normal">Update your personal details, achievements, and contact information.</p>
                </div>
                <div class="flex gap-3">
                    <a href="{{ url('admin_profile') }}" class="flex items-center justify-center px-4 h-10 rounded-lg border border-[#e5e2dc] bg-white dark:bg-[#2c261a] dark:border-[#362f22] dark:text-white text-[#171511] text-sm font-medium hover:bg-gray-50 dark:hover:bg-[#362f22]/80 transition-colors">
                        Cancel
                    </a>
                    <button type="button" class="hidden sm:flex items-center justify-center px-4 h-10 rounded-lg border border-[#e5e2dc] bg-white dark:bg-[#2c261a] dark:border-[#362f22] dark:text-white text-[#171511] text-sm font-medium hover:bg-gray-50 dark:hover:bg-[#362f22]/80 transition-colors">
                        Preview
                    </button>
                    <button type="submit" class="flex items-center justify-center px-4 h-10 rounded-lg bg-[#DA70D6] text-white text-sm font-bold shadow-md hover:opacity-90 transition-opacity">
                        <span class="material-symbols-outlined text-[20px] mr-2">save</span>
                        Save Changes
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 pb-12">
                <div class="lg:col-span-2 flex flex-col gap-6">
                    <!-- Personal Details Section -->
                    <section class="bg-white dark:bg-[#2c261a] rounded-xl p-6 shadow-sm border border-[#e5e2dc]/50 dark:border-[#362f22]">
                        <h2 class="text-[#171511] dark:text-white text-lg font-bold mb-4 flex items-center gap-2">
                            <span class="material-symbols-outlined text-[#40B5AD]">person</span>
                            Personal Details
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <label class="flex flex-col gap-2">
                                <span class="text-[#171511] dark:text-[#f8e8c9] text-sm font-medium">Full Name <span class="text-[#DA70D6]">*</span></span>
                                <input name="full_name" type="text" value="{{ old('full_name', $data['instructor']->full_name) }}" class="form-input w-full rounded-lg border border-[#e5e2dc] bg-background-light dark:bg-[#362f22] dark:border-[#4a402e] dark:text-white h-12 px-4 text-base focus:ring-2 focus:ring-[#DA70D6]/20 focus:border-[#DA70D6] outline-none transition-all placeholder:text-[#877b64]" placeholder="e.g. Sarah Connor" required />
                            </label>
                            <label class="flex flex-col gap-2">
                                <span class="text-[#171511] dark:text-[#f8e8c9] text-sm font-medium">Job Title / Role</span>
                                <input name="job_title" type="text" value="{{ old('job_title', $data['instructor']->job_title) }}" class="form-input w-full rounded-lg border border-[#e5e2dc] bg-background-light dark:bg-[#362f22] dark:border-[#4a402e] dark:text-white h-12 px-4 text-base focus:ring-2 focus:ring-[#DA70D6]/20 focus:border-[#DA70D6] outline-none transition-all placeholder:text-[#877b64]" placeholder="e.g. Senior Yoga Instructor" />
                            </label>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <label class="flex flex-col gap-2">
                                <span class="text-[#171511] dark:text-[#f8e8c9] text-sm font-medium">Email Address <span class="text-[#DA70D6]">*</span></span>
                                <input name="email_address" type="email" value="{{ old('email_address', $data['instructor']->email_address) }}" class="form-input w-full rounded-lg border border-[#e5e2dc] bg-background-light dark:bg-[#362f22] dark:border-[#4a402e] dark:text-white h-12 px-4 text-base focus:ring-2 focus:ring-[#DA70D6]/20 focus:border-[#DA70D6] outline-none transition-all placeholder:text-[#877b64]" placeholder="e.g. sarah@example.com" required />
                            </label>
                            <label class="flex flex-col gap-2">
                                <span class="text-[#171511] dark:text-[#f8e8c9] text-sm font-medium">Phone Number</span>
                                <input name="phone_number" type="text" value="{{ old('phone_number', $data['instructor']->phone_number) }}" class="form-input w-full rounded-lg border border-[#e5e2dc] bg-background-light dark:bg-[#362f22] dark:border-[#4a402e] dark:text-white h-12 px-4 text-base focus:ring-2 focus:ring-[#DA70D6]/20 focus:border-[#DA70D6] outline-none transition-all placeholder:text-[#877b64]" placeholder="e.g. +1 234 567 890" />
                            </label>
                        </div>
                    </section>

                    <!-- About Me Section -->
                    <section class="bg-white dark:bg-[#2c261a] rounded-xl p-6 shadow-sm border border-[#e5e2dc]/50 dark:border-[#362f22]">
                        <h2 class="text-[#171511] dark:text-white text-lg font-bold mb-4 flex items-center gap-2">
                            <span class="material-symbols-outlined text-[#40B5AD]">badge</span>
                            About Me
                        </h2>

                        <label class="flex flex-col gap-2 mb-6">
                            <div class="w-full rounded-lg border border-[#e5e2dc] bg-background-light dark:bg-[#362f22] dark:border-[#4a402e] overflow-hidden focus-within:ring-2 focus-within:ring-[#DA70D6]/20 focus-within:border-[#DA70D6] transition-all">
                                <textarea name="bio" class="w-full h-32 p-4 bg-transparent border-none outline-none resize-none text-[#171511] dark:text-white placeholder:text-[#877b64] text_area_admin" placeholder="Share your professional journey and philosophy...">{{ old('bio', $data['instructor']->about_me) }}</textarea>
                            </div>
                        </label>

                        <span class="text-[#171511] dark:text-[#f8e8c9] text-sm font-medium">List of Achievements</span>

                        <div id="achievements-section" class="space-y-4 mt-4">
                            <div id="achievements-container" class="space-y-6">
                                @foreach ($data['achievements'] as $index => $achievement)
                                <div
                                    class="achievement-row relative grid grid-cols-1 md:grid-cols-2 gap-4 border-b border-[#e5e2dc] pb-6 dark:border-[#4a402e]">

                                    {{-- Achievement Text --}}
                                    <label class="flex flex-col gap-2">
                                        <span class="text-[#171511] dark:text-[#f8e8c9] text-sm font-medium">
                                            Achievement
                                        </span>
                                        <div class="relative">
                                            <input
                                                type="text"
                                                name="achievements[{{ $index }}][achievement]"
                                                value="{{ $achievement->achievement }}"
                                                class="form-input w-full rounded-lg border border-[#e5e2dc] bg-background-light dark:bg-[#362f22] dark:border-[#4a402e] dark:text-white h-12 px-4 text-base focus:ring-2 focus:ring-[#DA70D6]/20 focus:border-[#DA70D6] outline-none transition-all"
                                                placeholder="e.g. Certified Yoga Instructor" />
                                        </div>
                                    </label>

                                    {{-- Icon Select --}}
                                    <label class="flex flex-col gap-2">
                                        <span class="text-[#171511] dark:text-[#f8e8c9] text-sm font-medium">
                                            Icon
                                        </span>
                                        <div class="relative">
                                            <select
                                                name="achievements[{{ $index }}][icon]"
                                                class="form-select w-full rounded-lg border border-[#e5e2dc] bg-background-light dark:bg-[#362f22] dark:border-[#4a402e] dark:text-white h-12 px-4 text-base focus:ring-2 focus:ring-[#DA70D6]/20 focus:border-[#DA70D6] outline-none transition-all appearance-none">

                                                <option value="">Select an icon...</option>
                                                <option value="trophy" {{ $achievement->icon === 'trophy' ? 'selected' : '' }}>🏆 Trophy</option>
                                                <option value="military_tech" {{ $achievement->icon === 'military_tech' ? 'selected' : '' }}>🎖️ Military Tech</option>
                                                <option value="workspace_premium" {{ $achievement->icon === 'workspace_premium' ? 'selected' : '' }}>⭐ Workspace Premium</option>
                                                <option value="emoji_events" {{ $achievement->icon === 'emoji_events' ? 'selected' : '' }}>🥇 Emoji Events</option>
                                                <option value="star" {{ $achievement->icon === 'star' ? 'selected' : '' }}>⭐ Star</option>
                                                <option value="verified" {{ $achievement->icon === 'verified' ? 'selected' : '' }}>✓ Verified</option>
                                                <option value="school" {{ $achievement->icon === 'school' ? 'selected' : '' }}>🎓 School</option>
                                                <option value="book" {{ $achievement->icon === 'book' ? 'selected' : '' }}>📚 Book</option>
                                                <option value="psychology" {{ $achievement->icon === 'psychology' ? 'selected' : '' }}>🧠 Psychology</option>
                                                <option value="health_and_safety" {{ $achievement->icon === 'health_and_safety' ? 'selected' : '' }}>🏥 Health Safety</option>
                                                <option value="fitness_center" {{ $achievement->icon === 'fitness_center' ? 'selected' : '' }}>💪 Fitness Center</option>
                                                <option value="self_improvement" {{ $achievement->icon === 'self_improvement' ? 'selected' : '' }}>🧘 Self Improvement</option>
                                                <option value="volunteer_activism" {{ $achievement->icon === 'volunteer_activism' ? 'selected' : '' }}>✊ Volunteer Activism</option>
                                                <option value="diversity" {{ $achievement->icon === 'diversity' ? 'selected' : '' }}>🤝 Diversity</option>
                                                <option value="science" {{ $achievement->icon === 'science' ? 'selected' : '' }}>🔬 Science</option>
                                            </select>

                                            <span
                                                class="material-symbols-outlined absolute right-4 top-3 text-[#877b64] pointer-events-none">
                                                expand_more
                                            </span>
                                        </div>
                                    </label>

                                    {{-- Remove Button --}}
                                    <button
                                        type="button"
                                        class="remove-achievement absolute -right-2 -top-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs opacity-0 hover:opacity-100 transition-opacity">
                                        ✕
                                    </button>
                                </div>
                                @endforeach
                            </div>

                            {{-- Add Button --}}
                            <button
                                type="button"
                                id="add-achievement"
                                class="flex items-center gap-2 text-[#DA70D6] font-medium py-2 px-4 rounded-lg border border-[#DA70D6] hover:bg-[#DA70D6]/10 transition-colors">
                                <span class="material-symbols-outlined">add_circle</span>
                                Add Achievement
                            </button>
                        </div>

                    </section>
                </div>

                <div class="flex flex-col gap-6">
                    <!-- Profile Photo Section -->
                    <section class="bg-white dark:bg-[#2c261a] rounded-xl p-6 shadow-sm border border-[#e5e2dc]/50 dark:border-[#362f22]">
                        <h2 class="text-[#171511] dark:text-white text-lg font-bold mb-4 flex items-center gap-2">
                            <span class="material-symbols-outlined text-[#40B5AD]">account_circle</span>
                            Profile Photo
                        </h2>

                        <div class="flex flex-col items-center justify-center w-full">

                            {{-- Current Image --}}
                            @if($data['instructor']->image)
                            <div class="mb-4 w-full" id="current-image">
                                <img
                                    src="{{ asset($data['instructor']->image) }}"
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
                                    name="profile_photo"
                                    type="file"
                                    accept="image/png,image/jpeg,image/jpg">
                            </label>
                        </div>
                    </section>


                    <!-- Social & Contact Section -->
                    <section class="bg-white dark:bg-[#2c261a] rounded-xl p-6 shadow-sm border border-[#e5e2dc]/50 dark:border-[#362f22]">
                        <h2 class="text-[#171511] dark:text-white text-lg font-bold mb-4 flex items-center gap-2">
                            <span class="material-symbols-outlined text-[#40B5AD]">share</span>
                            Social &amp; Contact
                        </h2>
                        <div class="flex flex-col gap-4">
                            <label class="flex flex-col gap-2">
                                <span class="text-[#171511] dark:text-[#f8e8c9] text-sm font-medium">Instagram Profile</span>
                                <div class="relative">
                                    <span class="material-symbols-outlined absolute left-3 top-3 text-[#877b64] text-[20px]">link</span>
                                    <input name="instagram_url" type="url" value="{{ old('instagram_url', $data['instructor']->instagram_url) }}" class="form-input w-full rounded-lg border border-[#e5e2dc] bg-background-light dark:bg-[#362f22] dark:border-[#4a402e] dark:text-white h-11 pl-10 pr-4 text-sm focus:ring-2 focus:ring-[#DA70D6]/20 focus:border-[#DA70D6] outline-none transition-all placeholder:text-[#877b64]" placeholder="https://instagram.com/username" />
                                </div>
                            </label>
                            <label class="flex flex-col gap-2">
                                <span class="text-[#171511] dark:text-[#f8e8c9] text-sm font-medium">Facebook Profile</span>
                                <div class="relative">
                                    <span class="material-symbols-outlined absolute left-3 top-3 text-[#877b64] text-[20px]">link</span>
                                    <input name="facebook_url" type="url" value="{{ old('facebook_url', $data['instructor']->facebook_url) }}" class="form-input w-full rounded-lg border border-[#e5e2dc] bg-background-light dark:bg-[#362f22] dark:border-[#4a402e] dark:text-white h-11 pl-10 pr-4 text-sm focus:ring-2 focus:ring-[#DA70D6]/20 focus:border-[#DA70D6] outline-none transition-all placeholder:text-[#877b64]" placeholder="https://facebook.com/username" />
                                </div>
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
    const container = document.getElementById('achievements-container');
    const addButton = document.getElementById('add-achievement');

    const MIN_ACHIEVEMENTS = 1;
    const MAX_ACHIEVEMENTS = 4;

    // Icon options for select dropdown
    const iconOptions = [{
            value: '',
            label: 'Select an icon...',
            emoji: ''
        },
        {
            value: 'trophy',
            label: 'Trophy',
            emoji: '🏆'
        },
        {
            value: 'military_tech',
            label: 'Military Tech',
            emoji: '🎖️'
        },
        {
            value: 'workspace_premium',
            label: 'Workspace Premium',
            emoji: '⭐'
        },
        {
            value: 'emoji_events',
            label: 'Emoji Events',
            emoji: '🥇'
        },
        {
            value: 'star',
            label: 'Star',
            emoji: '⭐'
        },
        {
            value: 'verified',
            label: 'Verified',
            emoji: '✓'
        },
        {
            value: 'school',
            label: 'School',
            emoji: '🎓'
        },
        {
            value: 'book',
            label: 'Book',
            emoji: '📚'
        },
        {
            value: 'psychology',
            label: 'Psychology',
            emoji: '🧠'
        },
        {
            value: 'health_and_safety',
            label: 'Health Safety',
            emoji: '🏥'
        },
        {
            value: 'fitness_center',
            label: 'Fitness Center',
            emoji: '💪'
        },
        {
            value: 'self_improvement',
            label: 'Self Improvement',
            emoji: '🧘'
        },
        {
            value: 'volunteer_activism',
            label: 'Volunteer Activism',
            emoji: '✊'
        },
        {
            value: 'diversity',
            label: 'Diversity',
            emoji: '🤝'
        },
        {
            value: 'science',
            label: 'Science',
            emoji: '🔬'
        }
    ];

    // Update delete button visibility
    function updateButtons() {
        const rows = container.querySelectorAll('.achievement-row');

        rows.forEach((row, index) => {
            const removeBtn = row.querySelector('.remove-achievement');
            // Hide delete if only 1 row exists
            if (rows.length <= MIN_ACHIEVEMENTS) {
                removeBtn.style.display = 'none';
            } else {
                removeBtn.style.display = 'flex';
                removeBtn.style.opacity = '1';
            }
        });

        // Disable add button if limit reached
        addButton.disabled = rows.length >= MAX_ACHIEVEMENTS;
        addButton.style.opacity = rows.length >= MAX_ACHIEVEMENTS ? '0.5' : '1';
        addButton.style.cursor = rows.length >= MAX_ACHIEVEMENTS ? 'not-allowed' : 'pointer';
    }

    // Add row
    addButton.addEventListener('click', () => {
        const rows = container.querySelectorAll('.achievement-row');
        if (rows.length < MAX_ACHIEVEMENTS) {
            const newIndex = rows.length;
            const newRow = rows[0].cloneNode(true);

            // Clear inputs and update names in the cloned row
            const input = newRow.querySelector('input[type="text"]');
            const select = newRow.querySelector('select');

            input.value = '';
            input.name = `achievements[${newIndex}][achievement]`;

            select.selectedIndex = 0;
            select.name = `achievements[${newIndex}][icon]`;

            container.appendChild(newRow);
            updateButtons();
        }
    });

    // Remove row (using event delegation)
    container.addEventListener('click', (e) => {
        if (e.target.classList.contains('remove-achievement')) {
            const rows = container.querySelectorAll('.achievement-row');
            if (rows.length > MIN_ACHIEVEMENTS) {
                e.target.closest('.achievement-row').remove();

                // Re-index remaining rows
                const remainingRows = container.querySelectorAll('.achievement-row');
                remainingRows.forEach((row, index) => {
                    row.querySelector('input[type="text"]').name = `achievements[${index}][achievement]`;
                    row.querySelector('select').name = `achievements[${index}][icon]`;
                });

                updateButtons();
            }
        }
    });

    // Initial check
    updateButtons();
</script>


@endsection