@extends('layouts.admin')
@section('content')
    <main class="flex-1 flex flex-col h-full relative overflow-y-auto bg-background-light dark:bg-background-dark">
        <div class="layout-container flex flex-col w-full max-w-[1200px] mx-auto px-6 py-8">
            <div class="flex flex-wrap gap-2 mb-6 items-center">
                <a class="text-[#877b64] hover:text-[#DA70D6] text-sm font-medium leading-normal transition-colors"
                    href="{{ url('')}}">Home</a>
                <span class="material-symbols-outlined text-[#877b64] text-sm">chevron_right</span>
                <a class="text-[#877b64] hover:text-[#DA70D6] text-sm font-medium leading-normal transition-colors"
                    href="{{ url('') }}">Instructors</a>
                <span class="material-symbols-outlined text-[#877b64] text-sm">chevron_right</span>
                <span class="text-[#171511] dark:text-white text-sm font-medium leading-normal">Update Profile</span>
            </div>

            <!-- Success Message -->
            @if(session('success'))
                <div
                    class="mb-6 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-800 dark:text-green-200 px-4 py-3 rounded-lg flex items-center gap-2">
                    <span class="material-symbols-outlined">check_circle</span>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <!-- Error Messages -->
            @if($errors->any())
                <div
                    class="mb-6 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-800 dark:text-red-200 px-4 py-3 rounded-lg">
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

            <form action="{{ url('update_instructor_profile/' . $data['instructor']->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div
                    class="flex flex-wrap justify-between items-end gap-4 mb-8 sticky top-0 bg-background-light dark:bg-background-dark z-20 py-2 border-b border-transparent">
                    <div class="flex flex-col gap-2">
                        <h1 class="text-[#171511] dark:text-white text-3xl font-black leading-tight tracking-tight">Update
                            Instructor Profile</h1>
                        <p class="text-[#877b64] text-base font-normal">Update your personal details, achievements, and
                            contact information.</p>
                    </div>
                    <div class="flex gap-3">
                        <a href="{{ url('admin_profile') }}"
                            class="flex items-center justify-center px-4 h-10 rounded-lg border border-[#e5e2dc] bg-white dark:bg-[#2c261a] dark:border-[#362f22] dark:text-white text-[#171511] text-sm font-medium hover:bg-gray-50 dark:hover:bg-[#362f22]/80 transition-colors">
                            Cancel
                        </a>
                        <button type="button"
                            class="hidden sm:flex items-center justify-center px-4 h-10 rounded-lg border border-[#e5e2dc] bg-white dark:bg-[#2c261a] dark:border-[#362f22] dark:text-white text-[#171511] text-sm font-medium hover:bg-gray-50 dark:hover:bg-[#362f22]/80 transition-colors">
                            Preview
                        </button>
                        <button type="submit"
                            class="flex items-center justify-center px-4 h-10 rounded-lg bg-[#DA70D6] text-white text-sm font-bold shadow-md hover:opacity-90 transition-opacity">
                            <span class="material-symbols-outlined text-[20px] mr-2">save</span>
                            Save Changes
                        </button>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 pb-12">
                    <div class="lg:col-span-2 flex flex-col gap-6">
                        <!-- Personal Details Section -->
                        <section
                            class="bg-white dark:bg-[#2c261a] rounded-xl p-6 shadow-sm border border-[#e5e2dc]/50 dark:border-[#362f22]">
                            <h2 class="text-[#171511] dark:text-white text-lg font-bold mb-4 flex items-center gap-2">
                                <span class="material-symbols-outlined text-[#40B5AD]">person</span>
                                Personal Details
                            </h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <label class="flex flex-col gap-2">
                                    <span class="text-[#171511] dark:text-[#f8e8c9] text-sm font-medium">Full Name <span
                                            class="text-[#DA70D6]">*</span></span>
                                    <input name="full_name" type="text"
                                        value="{{ old('full_name', $data['instructor']->full_name) }}"
                                        class="form-input w-full rounded-lg border border-[#e5e2dc] bg-background-light dark:bg-[#362f22] dark:border-[#4a402e] dark:text-white h-12 px-4 text-base focus:ring-2 focus:ring-[#DA70D6]/20 focus:border-[#DA70D6] outline-none transition-all placeholder:text-[#877b64]"
                                        placeholder="e.g. Sarah Connor" required />
                                </label>
                                <label class="flex flex-col gap-2">
                                    <span class="text-[#171511] dark:text-[#f8e8c9] text-sm font-medium">Job Title /
                                        Role</span>
                                    <input name="job_title" type="text"
                                        value="{{ old('job_title', $data['instructor']->job_title) }}"
                                        class="form-input w-full rounded-lg border border-[#e5e2dc] bg-background-light dark:bg-[#362f22] dark:border-[#4a402e] dark:text-white h-12 px-4 text-base focus:ring-2 focus:ring-[#DA70D6]/20 focus:border-[#DA70D6] outline-none transition-all placeholder:text-[#877b64]"
                                        placeholder="e.g. Senior Yoga Instructor" />
                                </label>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <label class="flex flex-col gap-2">
                                    <span class="text-[#171511] dark:text-[#f8e8c9] text-sm font-medium">Email Address <span
                                            class="text-[#DA70D6]">*</span></span>
                                    <input name="email_address" type="email"
                                        value="{{ old('email_address', $data['instructor']->email_address) }}"
                                        class="form-input w-full rounded-lg border border-[#e5e2dc] bg-background-light dark:bg-[#362f22] dark:border-[#4a402e] dark:text-white h-12 px-4 text-base focus:ring-2 focus:ring-[#DA70D6]/20 focus:border-[#DA70D6] outline-none transition-all placeholder:text-[#877b64]"
                                        placeholder="e.g. sarah@example.com" required />
                                </label>
                                <label class="flex flex-col gap-2">
                                    <span class="text-[#171511] dark:text-[#f8e8c9] text-sm font-medium">Phone Number</span>
                                    <input name="phone_number" type="text"
                                        value="{{ old('phone_number', $data['instructor']->phone_number) }}"
                                        class="form-input w-full rounded-lg border border-[#e5e2dc] bg-background-light dark:bg-[#362f22] dark:border-[#4a402e] dark:text-white h-12 px-4 text-base focus:ring-2 focus:ring-[#DA70D6]/20 focus:border-[#DA70D6] outline-none transition-all placeholder:text-[#877b64]"
                                        placeholder="e.g. +1 234 567 890" />
                                </label>
                            </div>
                        </section>

                        <!-- About Me Section -->
                        <section
                            class="bg-white dark:bg-[#2c261a] rounded-xl p-6 shadow-sm border border-[#e5e2dc]/50 dark:border-[#362f22]">
                            <h2 class="text-[#171511] dark:text-white text-lg font-bold mb-4 flex items-center gap-2">
                                <span class="material-symbols-outlined text-[#40B5AD]">badge</span>
                                About Me
                            </h2>

                            <label class="flex flex-col gap-2 mb-6">
                                <div
                                    class="w-full rounded-lg border border-[#e5e2dc] bg-background-light dark:bg-[#362f22] dark:border-[#4a402e] overflow-hidden focus-within:ring-2 focus-within:ring-[#DA70D6]/20 focus-within:border-[#DA70D6] transition-all">
                                    <textarea name="bio"
                                        class="w-full h-32 p-4 bg-transparent border-none outline-none resize-none text-[#171511] dark:text-white placeholder:text-[#877b64] text_area_admin"
                                        placeholder="Share your professional journey and philosophy...">{{ old('bio', $data['instructor']->about_me) }}</textarea>
                                </div>
                            </label>

                            <span class="text-[#171511] dark:text-[#f8e8c9] text-sm font-medium">List of Achievements</span>

                            <div id="achievements-section" class="space-y-4 mt-4">
                                <!-- Template for cloning -->
                                <div id="achievement-template" class="hidden">
                                    <div
                                        class="achievement-row relative grid grid-cols-1 md:grid-cols-2 gap-4 border-b border-[#e5e2dc] pb-6 dark:border-[#4a402e]">
                                        <label class="flex flex-col gap-2">
                                            <span
                                                class="text-[#171511] dark:text-[#f8e8c9] text-sm font-medium">Achievement</span>
                                            <input type="text" data-name="achievement"
                                                class="form-input w-full rounded-lg border border-[#e5e2dc] bg-background-light dark:bg-[#362f22] dark:border-[#4a402e] dark:text-white h-12 px-4"
                                                placeholder="e.g. Certified Yoga Instructor" />
                                        </label>
                                        <label class="flex flex-col gap-2">
                                            <span class="text-[#171511] dark:text-[#f8e8c9] text-sm font-medium">Icon</span>
                                            <div class="relative">
                                                <select data-name="icon"
                                                    class="form-select w-full rounded-lg border border-[#e5e2dc] bg-background-light dark:bg-[#362f22] dark:border-[#4a402e] dark:text-white h-12 px-4 appearance-none">
                                                    <option value="">Select an icon...</option>
                                                    <option value="trophy">🏆 Trophy</option>
                                                    <option value="military_tech">🎖️ Military Tech</option>
                                                    <option value="workspace_premium">⭐ Workspace Premium</option>
                                                    <option value="emoji_events">🥇 Emoji Events</option>
                                                    <option value="star">⭐ Star</option>
                                                    <option value="verified">✓ Verified</option>
                                                    <option value="school">🎓 School</option>
                                                    <option value="book">📚 Book</option>
                                                    <option value="psychology">🧠 Psychology</option>
                                                    <option value="health_and_safety">🏥 Health Safety</option>
                                                    <option value="fitness_center">💪 Fitness Center</option>
                                                    <option value="self_improvement">🧘 Self Improvement</option>
                                                    <option value="volunteer_activism">✊ Volunteer Activism</option>
                                                    <option value="diversity">🤝 Diversity</option>
                                                    <option value="science">🔬 Science</option>
                                                </select>
                                                <span
                                                    class="material-symbols-outlined absolute right-4 top-3 text-[#877b64] pointer-events-none">expand_more</span>
                                            </div>
                                        </label>
                                        <button type="button"
                                            class="remove-achievement absolute -right-2 -top-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs">✕</button>
                                    </div>
                                </div>

                                <div id="achievements-container" class="space-y-6">
                                    @forelse ($data['achievements'] as $index => $achievement)
                                        <div
                                            class="achievement-row relative grid grid-cols-1 md:grid-cols-2 gap-4 border-b border-[#e5e2dc] pb-6 dark:border-[#4a402e]">
                                            <label class="flex flex-col gap-2">
                                                <span
                                                    class="text-[#171511] dark:text-[#f8e8c9] text-sm font-medium">Achievement</span>
                                                <input type="text" name="achievements[{{ $index }}][achievement]"
                                                    value="{{ $achievement->achievement }}"
                                                    class="form-input w-full rounded-lg border border-[#e5e2dc] bg-background-light dark:bg-[#362f22] dark:border-[#4a402e] dark:text-white h-12 px-4" />
                                            </label>
                                            <label class="flex flex-col gap-2">
                                                <span class="text-[#171511] dark:text-[#f8e8c9] text-sm font-medium">Icon</span>
                                                <div class="relative">
                                                    <select name="achievements[{{ $index }}][icon]"
                                                        class="form-select w-full rounded-lg border border-[#e5e2dc] bg-background-light dark:bg-[#362f22] dark:border-[#4a402e] dark:text-white h-12 px-4 appearance-none">
                                                        <option value="">Select an icon...</option>
                                                        <option value="trophy" {{ $achievement->icon === 'trophy' ? 'selected' : '' }}>🏆 Trophy</option>
                                                        <option value="military_tech" {{ $achievement->icon === 'military_tech' ? 'selected' : '' }}>🎖️ Military Tech</option>
                                                        <option value="workspace_premium" {{ $achievement->icon === 'workspace_premium' ? 'selected' : '' }}>⭐
                                                            Workspace Premium</option>
                                                        <option value="emoji_events" {{ $achievement->icon === 'emoji_events' ? 'selected' : '' }}>🥇 Emoji Events</option>
                                                        <option value="star" {{ $achievement->icon === 'star' ? 'selected' : '' }}>⭐ Star</option>
                                                        <option value="verified" {{ $achievement->icon === 'verified' ? 'selected' : '' }}>✓ Verified</option>
                                                        <option value="school" {{ $achievement->icon === 'school' ? 'selected' : '' }}>🎓 School</option>
                                                        <option value="book" {{ $achievement->icon === 'book' ? 'selected' : '' }}>📚 Book</option>
                                                        <option value="psychology" {{ $achievement->icon === 'psychology' ? 'selected' : '' }}>🧠 Psychology</option>
                                                        <option value="health_and_safety" {{ $achievement->icon === 'health_and_safety' ? 'selected' : '' }}>🏥
                                                            Health Safety</option>
                                                        <option value="fitness_center" {{ $achievement->icon === 'fitness_center' ? 'selected' : '' }}>💪 Fitness Center</option>
                                                        <option value="self_improvement" {{ $achievement->icon === 'self_improvement' ? 'selected' : '' }}>🧘 Self
                                                            Improvement</option>
                                                        <option value="volunteer_activism" {{ $achievement->icon === 'volunteer_activism' ? 'selected' : '' }}>✊
                                                            Volunteer Activism</option>
                                                        <option value="diversity" {{ $achievement->icon === 'diversity' ? 'selected' : '' }}>🤝 Diversity</option>
                                                        <option value="science" {{ $achievement->icon === 'science' ? 'selected' : '' }}>🔬 Science</option>
                                                    </select>
                                                    <span
                                                        class="material-symbols-outlined absolute right-4 top-3 text-[#877b64] pointer-events-none">expand_more</span>
                                                </div>
                                            </label>
                                            <button type="button"
                                                class="remove-achievement absolute -right-2 -top-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs">✕</button>
                                        </div>
                                    @empty
                                        <!-- Empty state handled by template + script -->
                                    @endforelse
                                </div>

                                <button type="button" id="add-achievement"
                                    class="flex items-center gap-2 text-[#DA70D6] font-medium py-2 px-4 rounded-lg border border-[#DA70D6] hover:bg-[#DA70D6]/10 transition-colors">
                                    <span class="material-symbols-outlined">add_circle</span> Add Achievement
                                </button>
                            </div>
                        </section>

                        <!-- About Me Bubbles Section -->
                        <section
                            class="bg-white dark:bg-[#2c261a] rounded-xl p-6 shadow-sm border border-[#e5e2dc]/50 dark:border-[#362f22]">
                            <h2 class="text-[#171511] dark:text-white text-lg font-bold mb-4 flex items-center gap-2">
                                <span class="material-symbols-outlined text-[#40B5AD]">bubble_chart</span>
                                About Me Bubbles
                            </h2>

                            <div id="bubbles-section" class="space-y-4">
                                <!-- Template for cloning -->
                                <div id="bubble-template" class="hidden">
                                    <div
                                        class="bubble-row relative grid grid-cols-4 gap-4 border-b border-[#e5e2dc] pb-6 dark:border-[#4a402e]">
                                        <div class="col-span-3">
                                            <label class="flex flex-col gap-2">
                                                <span class="text-[#171511] dark:text-[#f8e8c9] text-sm font-medium">Bubble
                                                    Text</span>
                                                <input type="text" data-name="text"
                                                    class="form-input w-full rounded-lg border border-[#e5e2dc] bg-background-light dark:bg-[#362f22] dark:border-[#4a402e] dark:text-white h-12 px-4"
                                                    placeholder="e.g. 5+ Years Experience" />
                                            </label>
                                        </div>
                                        <div class="col-span-1">
                                            <label class="flex flex-col gap-2">
                                                <span
                                                    class="text-[#171511] dark:text-[#f8e8c9] text-sm font-medium">Rank</span>
                                                <input type="number" data-name="rank_position"
                                                    class="form-input w-full rounded-lg border border-[#e5e2dc] bg-background-light dark:bg-[#362f22] dark:border-[#4a402e] dark:text-white h-12 px-4"
                                                    placeholder="1" />
                                            </label>
                                        </div>
                                        <button type="button"
                                            class="remove-bubble absolute -right-2 -top-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs">✕</button>
                                    </div>
                                </div>

                                <div id="bubbles-container" class="space-y-6">
                                    @foreach ($data['bubbles'] as $index => $bubble)
                                        <div
                                            class="bubble-row relative grid grid-cols-4 gap-4 border-b border-[#e5e2dc] pb-6 dark:border-[#4a402e]">
                                            <div class="col-span-3">
                                                <label class="flex flex-col gap-2">
                                                    <span class="text-[#171511] dark:text-[#f8e8c9] text-sm font-medium">Bubble
                                                        Text</span>
                                                    <input type="text" name="bubbles[{{ $index }}][text]"
                                                        value="{{ $bubble->text }}"
                                                        class="form-input w-full rounded-lg border border-[#e5e2dc] bg-background-light dark:bg-[#362f22] dark:border-[#4a402e] dark:text-white h-12 px-4" />
                                                </label>
                                            </div>
                                            <div class="col-span-1">
                                                <label class="flex flex-col gap-2">
                                                    <span
                                                        class="text-[#171511] dark:text-[#f8e8c9] text-sm font-medium">Rank</span>
                                                    <input type="number" name="bubbles[{{ $index }}][rank_position]"
                                                        value="{{ $bubble->rank_position }}"
                                                        class="form-input w-full rounded-lg border border-[#e5e2dc] bg-background-light dark:bg-[#362f22] dark:border-[#4a402e] dark:text-white h-12 px-4" />
                                                </label>
                                            </div>
                                            <button type="button"
                                                class="remove-bubble absolute -right-2 -top-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs">✕</button>
                                        </div>
                                    @endforeach
                                </div>

                                <button type="button" id="add-bubble"
                                    class="flex items-center gap-2 text-[#40B5AD] font-medium py-2 px-4 rounded-lg border border-[#40B5AD] hover:bg-[#40B5AD]/10 transition-colors">
                                    <span class="material-symbols-outlined">add_circle</span> Add Bubble
                                </button>
                            </div>
                        </section>
                    </div>

                    <div class="flex flex-col gap-6">
                        <!-- Profile Photo Section -->
                        <section
                            class="bg-white dark:bg-[#2c261a] rounded-xl p-6 shadow-sm border border-[#e5e2dc]/50 dark:border-[#362f22]">
                            <h2 class="text-[#171511] dark:text-white text-lg font-bold mb-4 flex items-center gap-2">
                                <span class="material-symbols-outlined text-[#40B5AD]">account_circle</span>
                                Profile Photo
                            </h2>

                            <div class="flex flex-col items-center justify-center w-full">

                                {{-- Current Image --}}
                                @if($data['instructor']->image)
                                    <div class="mb-4 w-full" id="current-image">
                                        <img src="{{ asset($data['instructor']->image) }}" alt="Current Profile Photo"
                                            class="w-full h-48 object-cover rounded-lg">
                                        <p class="text-xs text-[#877b64] text-center mt-2">Current photo</p>
                                    </div>
                                @endif

                                {{-- Selected Image Preview --}}
                                <div class="mb-4 w-full hidden" id="image-preview-wrapper">
                                    <img id="image-preview" src="" alt="Selected Profile Photo"
                                        class="w-full h-48 object-cover rounded-lg">
                                    <p class="text-xs text-[#877b64] text-center mt-2">Selected photo</p>
                                </div>

                                {{-- Upload Area --}}
                                <label for="dropzone-file"
                                    class="flex flex-col items-center justify-center w-full h-64 border-2 border-[#e5e2dc] border-dashed rounded-lg cursor-pointer bg-background-light dark:bg-[#362f22] dark:border-[#4a402e] hover:bg-primary/30 dark:hover:bg-[#362f22]/50 transition-colors group">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <span
                                            class="material-symbols-outlined text-4xl text-[#DA70D6] mb-3 group-hover:scale-110 transition-transform">
                                            add_a_photo
                                        </span>
                                        <p class="mb-2 text-sm text-[#171511] dark:text-white">
                                            <span class="font-bold">Click to upload</span> or drag and drop
                                        </p>
                                        <p class="text-xs text-[#877b64]">PNG, JPG (MAX. 500x500px)</p>
                                    </div>

                                    <input class="hidden" id="dropzone-file" name="profile_photo" type="file"
                                        accept="image/png,image/jpeg,image/jpg">
                                </label>
                            </div>
                        </section>


                        <!-- Social & Contact Section -->
                        <section
                            class="bg-white dark:bg-[#2c261a] rounded-xl p-6 shadow-sm border border-[#e5e2dc]/50 dark:border-[#362f22]">
                            <h2 class="text-[#171511] dark:text-white text-lg font-bold mb-4 flex items-center gap-2">
                                <span class="material-symbols-outlined text-[#40B5AD]">share</span>
                                Social &amp; Contact
                            </h2>
                            <div class="flex flex-col gap-4">
                                <label class="flex flex-col gap-2">
                                    <span class="text-[#171511] dark:text-[#f8e8c9] text-sm font-medium">Instagram
                                        Profile</span>
                                    <div class="relative">
                                        <span
                                            class="material-symbols-outlined absolute left-3 top-3 text-[#877b64] text-[20px]">link</span>
                                        <input name="instagram_url" type="url"
                                            value="{{ old('instagram_url', $data['instructor']->instagram_url) }}"
                                            class="form-input w-full rounded-lg border border-[#e5e2dc] bg-background-light dark:bg-[#362f22] dark:border-[#4a402e] dark:text-white h-11 pl-10 pr-4 text-sm focus:ring-2 focus:ring-[#DA70D6]/20 focus:border-[#DA70D6] outline-none transition-all placeholder:text-[#877b64]"
                                            placeholder="https://instagram.com/username" />
                                    </div>
                                </label>
                                <label class="flex flex-col gap-2">
                                    <span class="text-[#171511] dark:text-[#f8e8c9] text-sm font-medium">Facebook
                                        Profile</span>
                                    <div class="relative">
                                        <span
                                            class="material-symbols-outlined absolute left-3 top-3 text-[#877b64] text-[20px]">link</span>
                                        <input name="facebook_url" type="url"
                                            value="{{ old('facebook_url', $data['instructor']->facebook_url) }}"
                                            class="form-input w-full rounded-lg border border-[#e5e2dc] bg-background-light dark:bg-[#362f22] dark:border-[#4a402e] dark:text-white h-11 pl-10 pr-4 text-sm focus:ring-2 focus:ring-[#DA70D6]/20 focus:border-[#DA70D6] outline-none transition-all placeholder:text-[#877b64]"
                                            placeholder="https://facebook.com/username" />
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
        // Achievement Management
        const achievementContainer = document.getElementById('achievements-container');
        const achievementTemplate = document.getElementById('achievement-template').firstElementChild;
        const addAchievementBtn = document.getElementById('add-achievement');
        const MAX_ACHIEVEMENTS = 5;

        function updateAchievementIndexes() {
            const rows = achievementContainer.querySelectorAll('.achievement-row');
            rows.forEach((row, index) => {
                const input = row.querySelector('input[type="text"]');
                const select = row.querySelector('select');
                if (input) input.name = `achievements[${index}][achievement]`;
                if (select) select.name = `achievements[${index}][icon]`;

                const removeBtn = row.querySelector('.remove-achievement');
                if (removeBtn) removeBtn.style.display = rows.length > 1 ? 'flex' : 'none';
            });
            // Updated: Button remains enabled to allow alert feedback
            addAchievementBtn.style.opacity = rows.length >= MAX_ACHIEVEMENTS ? '0.5' : '1';
        }

        addAchievementBtn.addEventListener('click', () => {
            if (achievementContainer.querySelectorAll('.achievement-row').length < MAX_ACHIEVEMENTS) {
                const newRow = achievementTemplate.cloneNode(true); 
                const input = newRow.querySelector('[data-name="achievement"]'); 
                const select = newRow.querySelector('[data-name="icon"]'); 
                if (input) input.name = `achievements[${achievementContainer.children.length}][achievement]`; 
                if (select) select.name = `achievements[${achievementContainer.children.length}][icon]`; 
                achievementContainer.appendChild(newRow);
                updateAchievementIndexes();
            } else {
                alert('You have reached the maximum limit of ' + MAX_ACHIEVEMENTS + ' achievements.');
            }
        }); 

        achievementContainer.addEventListener('click', (e) => {
            if (e.target.closest('.remove-achievement')) {
                e.target.closest('.achievement-row').remove();
                updateAchievementIndexes();
            }
        });

        // Bubble Management
        const bubbleContainer = document.getElementById('bubbles-container');
        const bubbleTemplate = document.getElementById('bubble-template').firstElementChild;
        const addBubbleBtn = document.getElementById('add-bubble');
        const MAX_BUBBLES = 5;

        function updateBubbleIndexes() {
            const rows = bubbleContainer.querySelectorAll('.bubble-row');
            rows.forEach((row, index) => {
                const textInput = row.querySelector('input[type="text"]');
                const rankInput = row.querySelector('input[type="number"]');
                if (textInput) textInput.name = `bubbles[${index}][text]`;
                if (rankInput) rankInput.name = `bubbles[${index}][rank_position]`;

                const removeBtn = row.querySelector('.remove-bubble');
                if (removeBtn) removeBtn.style.display = rows.length > 1 ? 'flex' : 'none';
            });
            addBubbleBtn.style.opacity = rows.length >= MAX_BUBBLES ? '0.5' : '1';
        }

        addBubbleBtn.addEventListener('click', () => {
            if (bubbleContainer.querySelectorAll('.bubble-row').length < MAX_BUBBLES) {
                const newRow = bubbleTemplate.cloneNode(true);
                const textInput = newRow.querySelector('[data-name="text"]');
                const rankInput = newRow.querySelector('[data-name="rank_position"]');
                if (textInput) textInput.name = `bubbles[${bubbleContainer.children.length}][text]`;
                if (rankInput) rankInput.name = `bubbles[${bubbleContainer.children.length}][rank_position]`;
                bubbleContainer.appendChild(newRow);
                updateBubbleIndexes();
            } else {
                alert('You have reached the maximum limit of ' + MAX_BUBBLES + ' bubbles.');
            }
        });

        bubbleContainer.addEventListener('click', (e) => {
            if (e.target.closest('.remove-bubble')) {
                e.target.closest('.bubble-row').remove();
                updateBubbleIndexes();
            }
        });

        // Handle Profile Photo Preview
        document.getElementById('dropzone-file').addEventListener('change', function (e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (event) {
                    const preview = document.getElementById('image-preview');
                    const wrapper = document.getElementById('image-preview-wrapper');
                    const current = document.getElementById('current-image');

                    preview.src = event.target.result;
                    wrapper.classList.remove('hidden');
                    if (current) current.classList.add('hidden');
                };
                reader.readAsDataURL(file);
            }
        });

        // Initial load
        updateAchievementIndexes();
        updateBubbleIndexes();
    </script>
@endsection