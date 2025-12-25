@extends('layouts.client')
@section('content')

<body class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-white font-display overflow-hidden h-screen flex">
    <main class="flex-1 flex flex-col min-w-0 bg-background-dark h-full relative">
        @include('layouts.include.dark_header')
        <div class="flex-1 overflow-y-auto">
            <div class="p-6 lg:p-10 max-w-7xl mx-auto space-y-10">
                <section class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
                    <div class="lg:col-span-2 space-y-6">
                        <!-- Video Player Section -->
                        <div id="lesson-video-container" class="relative rounded-2xl overflow-hidden bg-black aspect-video group">
                            <div class="absolute inset-0 bg-cover bg-center" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCKacK5OZ9M587liCd_Z1yzO6Uctw6kUfnCAZOb4iBrtfRjJyI9G5SJccAGEtGtFnm0NR-ckflWrtvVvg6obdK-NRX35LuXLPdQVHElsb-wktUCoCgBZEpOmSDWKjuaHyuoHut7jVQzE3vU8smQtZsNUJ6ZNYum8w4tx6uTHGKwN0O46xTcWgdbsZvs3igMn-YCDoxJaNBp1OhjsbDAKQuPunUacCd9Dlsa5fqKzkkN9siRD5VNEmkVROrnKdsgVpO8iKGnzoRr1ik");'></div>
                            <div class="absolute inset-0 bg-black/40 flex items-center justify-center group-hover:bg-black/50 transition-colors cursor-pointer">
                                <div class="size-20 bg-white/20 backdrop-blur-md rounded-full flex items-center justify-center pl-1 border border-white/30 text-white shadow-2xl transition-transform hover:scale-110">
                                    <span class="material-symbols-outlined text-5xl fill">play_arrow</span>
                                </div>
                            </div>
                            <div class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-black/90 to-transparent">
                                <div class="h-1 bg-white/30 rounded-full mb-4 cursor-pointer">
                                    <div class="h-full bg-primary w-1/3 rounded-full relative">
                                        <div class="absolute right-0 top-1/2 -translate-y-1/2 size-3 bg-white rounded-full shadow"></div>
                                    </div>
                                </div>
                                <div class="flex justify-between items-center text-white">
                                    <div class="flex items-center gap-4">
                                        <span class="material-symbols-outlined cursor-pointer hover:text-primary">play_arrow</span>
                                        <span class="material-symbols-outlined cursor-pointer hover:text-primary">volume_up</span>
                                        <span class="text-sm font-medium">12:34 / 45:00</span>
                                    </div>
                                    <div class="flex items-center gap-4">
                                        <span class="material-symbols-outlined cursor-pointer hover:text-primary">settings</span>
                                        <span class="material-symbols-outlined cursor-pointer hover:text-primary">fullscreen</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="flex flex-wrap gap-3 mb-4">
                                <span class="bg-surface-dark border border-border-dark text-[#b5a1b4] px-3 py-1 rounded-full text-sm font-medium flex items-center gap-1">
                                    <span class="material-symbols-outlined text-base">schedule</span>
                                    Total duration: {{$course_details->course_duration}} {{$course_details->duration_unit}}
                                </span>
                                <span class="bg-surface-dark border border-border-dark text-[#b5a1b4] px-3 py-1 rounded-full text-sm font-medium flex items-center gap-1">
                                    <span class="material-symbols-outlined text-base">signal_cellular_alt</span>
                                    {{$course_details->category}}
                                </span>
                            </div>
                            <h1 id="lesson-title" class="text-3xl font-bold text-white mb-3">{{$course_details->course_name}}</h1>
                            <p id="lesson-description" class="text-gray-400 leading-relaxed text-lg">
                                {{$course_details->description}}
                            </p>
                            <div class="flex items-center gap-4 mt-6 pt-6 border-t border-border-dark">
                                <div class="size-12 rounded-full bg-gray-700 bg-cover bg-center border-2 border-primary" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuAcD-XmeqP62hhhZfoVbORzb8d-cTzulhbBHl2AuQhEnqWXixL_fUEkvw7SIbrzttZEXRG3z-xJJqf9F-4MwhJf4y6zzH9Lt-p_-cCJAsi1U-aHs4__657Ot6x7zd11CPNecZPIs6Fd0tnwc3bIXLs3jaB5R7MVSiLrbUyWecLESWOZTdmgwxRMdeJAmdTHCGxVrnt5eprDWu0uw7hNn46Y2VK4EGlds2GpsAjWkmVFthivrB1hUY1xq9Toz5uOVzAjzVFpzOCt-Go")'></div>
                                <div>
                                    <p class="text-white font-bold">{{$instructor->full_name}}</p>
                                    <p class="text-secondary text-sm">{{$instructor->job_title}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-surface-dark rounded-2xl p-6 border border-border-dark sticky top-24">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-white font-bold text-lg">Course Progress</h3>
                            <span class="text-primary font-bold">35%</span>
                        </div>
                        <div class="h-2 w-full bg-background-dark rounded-full overflow-hidden mb-6">
                            <div class="h-full bg-primary w-[35%] rounded-full"></div>
                        </div>
                        <div class="space-y-4">
                            <div class="flex items-center gap-4 text-gray-300">
                                <div class="size-10 rounded-lg bg-background-dark flex items-center justify-center text-secondary">
                                    <span class="material-symbols-outlined">play_lesson</span>
                                </div>
                                <div>
                                    <p class="text-xs text-[#b5a1b4]">Lessons</p>
                                    <p class="font-bold">8 / 24 Completed</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4 text-gray-300">
                                <div class="size-10 rounded-lg bg-background-dark flex items-center justify-center text-tertiary">
                                    <span class="material-symbols-outlined">quiz</span>
                                </div>
                                <div>
                                    <p class="text-xs text-[#b5a1b4]">Quizzes</p>
                                    <p class="font-bold">2 / 5 Passed</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4 text-gray-300">
                                <div class="size-10 rounded-lg bg-background-dark flex items-center justify-center text-primary">
                                    <span class="material-symbols-outlined">download</span>
                                </div>
                                <div>
                                    <p class="text-xs text-[#b5a1b4]">Resources</p>
                                    <p class="font-bold">12 Files Available</p>
                                </div>
                            </div>
                        </div>
                        <button class="w-full mt-8 bg-primary hover:bg-primary/90 text-[#171217] font-bold py-3 rounded-xl transition-colors">
                            Continue Learning
                        </button>
                    </div>
                </section>
                <section>
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-2xl font-bold text-white">Course Curriculum</h3>
                        <div class="flex gap-2">
                            <button class="text-sm text-[#b5a1b4] hover:text-white px-3 py-1.5 rounded bg-surface-dark hover:bg-surface-dark/80 transition-colors">Expand All</button>
                            <button class="text-sm text-[#b5a1b4] hover:text-white px-3 py-1.5 rounded bg-surface-dark hover:bg-surface-dark/80 transition-colors">Collapse All</button>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div class="border border-border-dark rounded-xl overflow-hidden bg-surface-dark/30">
                            <div class="bg-surface-dark p-4 flex items-center justify-between cursor-pointer">
                                <div class="flex items-center gap-3">
                                    <span class="bg-primary/20 text-primary size-6 flex items-center justify-center rounded text-xs font-bold">1</span>
                                    <h4 class="text-white font-semibold">Introduction to Breathwork</h4>
                                </div>
                                <div class="flex items-center gap-4 text-sm text-[#b5a1b4]">
                                    <span>3 Lessons • 45m</span>
                                    <span class="material-symbols-outlined">keyboard_arrow_up</span>
                                </div>
                            </div>
                            @foreach ($course_lessons as $lesson)
                            <div class="p-4 border-t border-border-dark bg-background-dark/50 hover:bg-background-dark transition-colors">
                                <div class="flex flex-col md:flex-row gap-6">
                                    <div class="relative w-full md:w-48 aspect-video rounded-lg overflow-hidden bg-surface-dark flex-shrink-0 group cursor-pointer">
                                        <div class="absolute inset-0 bg-cover bg-center opacity-60 group-hover:opacity-100 transition-opacity" style="background-image: url('{{ asset($course_details->cover_image) }}');"></div>
                                        <div class="absolute inset-0 flex items-center justify-center">
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex justify-between items-start mb-2">
                                            <h5 class="text-white font-medium text-lg group-hover:text-primary transition-colors cursor-pointer">{{$lesson->lesson_number}} . {{$lesson->lesson_title}}</h5>
                                            <span class="text-secondary text-xs bg-secondary/10 px-2 py-1 rounded font-medium flex items-center gap-1">
                                                <span class="material-symbols-outlined text-sm">check_circle</span> Completed
                                            </span>
                                        </div>
                                        <p class="text-sm text-[#b5a1b4] mb-4 line-clamp-2">
                                            {{$lesson->description}}
                                        </p>
                                        <div class="flex items-center gap-3">
                                            <button
                                                data-course-id="{{$lesson->course_id}}"
                                                data-lesson-number="{{$lesson->lesson_number}}"
                                                data-lesson-title="{{$lesson->lesson_number}} . {{$lesson->lesson_title}}"
                                                data-lesson-description="{{$lesson->description}}"
                                                data-video-url="{{ asset($lesson->video_url ?? '') }}"
                                                type="button"
                                                class="play_lesson_video inline-flex items-center gap-2 text-xs font-medium text-primary border border-primary/30 px-3 py-1.5 rounded hover:bg-primary/10 transition-colors stop-propagation">
                                                <span class="material-symbols-outlined text-sm">play_circle</span>
                                                Play Course
                                            </button>

                                            <button
                                                data-course-id="{{$lesson->course_id}}"
                                                data-lesson-number="{{$lesson->lesson_number}}"
                                                data-pptx-url="{{ asset($lesson->powerpoint_url ?? '') }}"
                                                data-lesson-title="{{$lesson->lesson_title}}"
                                                class="download_powerpoint inline-flex items-center gap-2 text-xs font-medium text-tertiary border border-tertiary/30 px-3 py-1.5 rounded hover:bg-tertiary/10 transition-colors stop-propagation">
                                                <span class="material-symbols-outlined text-sm">description</span>
                                                Download Slides (PPTX)
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </section>
                <section class="bg-surface-dark rounded-2xl p-8 border border-border-dark">
                    <h3 class="text-xl font-bold text-white mb-6">About the Instructor</h3>
                    <div class="flex flex-col md:flex-row gap-8 items-start">
                        <div class="w-full md:w-48 flex-shrink-0 text-center md:text-left">
                            <div class="size-32 rounded-full bg-gray-600 bg-cover bg-center border-4 border-background-dark mx-auto md:mx-0 shadow-xl" style="background-image: url('{{ asset($instructor->image) }}');"></div>
                            <div class="mt-4 flex justify-center md:justify-start gap-2">
                                <button class="size-8 rounded-full bg-background-dark flex items-center justify-center text-[#b5a1b4] hover:text-white hover:bg-primary transition-colors">
                                    <span class="material-symbols-outlined text-sm">mail</span>
                                </button>
                                <button class="size-8 rounded-full bg-background-dark flex items-center justify-center text-[#b5a1b4] hover:text-white hover:bg-primary transition-colors">
                                    <span class="material-symbols-outlined text-sm">language</span>
                                </button>
                            </div>
                        </div>
                        <div class="flex-1">
                            <h4 class="text-2xl font-bold text-white">{{$instructor->full_name}}</h4>
                            <p class="text-secondary font-medium mb-4">{{$instructor->job_title}}</p>
                            <div class="space-y-4 text-gray-300 text-sm leading-relaxed">
                                <p>
                                    {!!$instructor->about_me!!}
                                </p>
                            </div>
                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mt-8 pt-6 border-t border-border-dark">
                                <div>
                                    <p class="text-2xl font-bold text-white">{{$all_courses_count}}</p>
                                    <p class="text-xs text-[#b5a1b4] uppercase tracking-wide">Courses</p>
                                </div>
                                <div>
                                    <p class="text-2xl font-bold text-white">4.9</p>
                                    <p class="text-xs text-[#b5a1b4] uppercase tracking-wide">Rating</p>
                                </div>
                                <div>
                                    <p class="text-2xl font-bold text-white">15k+</p>
                                    <p class="text-xs text-[#b5a1b4] uppercase tracking-wide">Students</p>
                                </div>
                                <div>
                                    <p class="text-2xl font-bold text-white">150+</p>
                                    <p class="text-xs text-[#b5a1b4] uppercase tracking-wide">Reviews</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </main>

    <!-- Toast Notification Container -->
    <div id="toast-container" class="fixed top-4 right-4 z-50 space-y-2"></div>
</body>
@endsection
@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Play Lesson Video Function
        document.querySelectorAll('.play_lesson_video').forEach(button => {
            button.addEventListener('click', function(e) {
                e.stopPropagation();

                const courseId = this.getAttribute('data-course-id');
                const lessonNumber = this.getAttribute('data-lesson-number');
                const lessonTitle = this.getAttribute('data-lesson-title');
                const lessonDescription = this.getAttribute('data-lesson-description');

                // Show loading state
                const originalContent = button.innerHTML;
                button.disabled = true;
                button.innerHTML = `
                    <span class="material-symbols-outlined text-sm animate-spin">refresh</span>
                    Loading...
                `;

                // AJAX call to get video URL
                $.ajax({
                    url: `/course/get_video_url/${courseId}/${lessonNumber}`,
                    method: "GET",
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        console.log(response)
                        button.disabled = false;
                        button.innerHTML = originalContent;
                        
                        if (response.success && response.video_url) {
                            // Update video player with new lesson
                            updateVideoPlayer(response.video_url, lessonTitle, lessonDescription);
                            
                            // Scroll to video section
                            document.getElementById('lesson-video-container').scrollIntoView({
                                behavior: 'smooth',
                                block: 'start'
                            });
                        } else {
                            showToast(response.message || 'Video not available for this lesson', 'error');
                        }
                    },
                    error: function(xhr) {
                        button.disabled = false;
                        button.innerHTML = originalContent;
                        console.error("Error fetching video:", xhr.responseText);
                        
                        let errorMessage = 'Failed to load video';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }
                        showToast(errorMessage, 'error');
                    }
                });
            });
        });

        // Download PowerPoint Function
        document.querySelectorAll('.download_powerpoint').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                const courseId = this.getAttribute('data-course-id');
                const lessonNumber = this.getAttribute('data-lesson-number');
                const lessonTitle = this.getAttribute('data-lesson-title');

                // Show loading state
                const originalContent = button.innerHTML;
                button.disabled = true;
                button.innerHTML = `
                    <span class="material-symbols-outlined text-sm animate-spin">refresh</span>
                    Preparing...
                `;

                // AJAX call to get PPTX URL
                $.ajax({
                    url: `/course/get_pptx_url/${courseId}/${lessonNumber}`,
                    method: "GET",
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        button.disabled = false;
                        button.innerHTML = originalContent;
                        
                        if (response.success && response.pptx_url) {
                            // Start download
                            downloadPowerPoint(courseId, response.pptx_url, lessonTitle, button);
                        } else {
                            showToast(response.message || 'PowerPoint not available for this lesson', 'error');
                        }
                    },
                    error: function(xhr) {
                        button.disabled = false;
                        button.innerHTML = originalContent;
                        console.error("Error fetching PowerPoint:", xhr.responseText);
                        
                        let errorMessage = 'Failed to download PowerPoint';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }
                        showToast(errorMessage, 'error');
                    }
                });
            });
        });
    });

    // Function to update video player
    function updateVideoPlayer(videoUrl, title, description) {
        const videoContainer = document.getElementById('lesson-video-container');
        const titleElement = document.getElementById('lesson-title');
        const descriptionElement = document.getElementById('lesson-description');

        if (!videoUrl) {
            showToast('Video not available for this lesson', 'error');
            return;
        }

        // Update video container with actual video player
        videoContainer.innerHTML = `
        <video 
            id="lesson-video-player" 
            class="w-full h-full object-cover" 
            controls 
            autoplay
            controlsList="nodownload">
            <source src="${videoUrl}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <button 
            id="close-video-btn"
            class="absolute top-4 right-4 bg-black/70 hover:bg-black/90 text-white p-2 rounded-full transition-colors z-10">
            <span class="material-symbols-outlined">close</span>
        </button>
    `;

        // Update title and description
        titleElement.textContent = title;
        descriptionElement.textContent = description;

        // Add close button functionality
        document.getElementById('close-video-btn').addEventListener('click', function() {
            resetVideoPlayer();
        });

        showToast('Playing: ' + title, 'success');
    }

    // Function to reset video player to thumbnail view
    function resetVideoPlayer() {
        const videoContainer = document.getElementById('lesson-video-container');

        videoContainer.innerHTML = `
        <div class="absolute inset-0 bg-cover bg-center" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCKacK5OZ9M587liCd_Z1yzO6Uctw6kUfnCAZOb4iBrtfRjJyI9G5SJccAGEtGtFnm0NR-ckflWrtvVvg6obdK-NRX35LuXLPdQVHElsb-wktUCoCgBZEpOmSDWKjuaHyuoHut7jVQzE3vU8smQtZsNUJ6ZNYum8w4tx6uTHGKwN0O46xTcWgdbsZvs3igMn-YCDoxJaNBp1OhjsbDAKQuPunUacCd9Dlsa5fqKzkkN9siRD5VNEmkVROrnKdsgVpO8iKGnzoRr1ik");'></div>
        <div class="absolute inset-0 bg-black/40 flex items-center justify-center group-hover:bg-black/50 transition-colors cursor-pointer">
            <div class="size-20 bg-white/20 backdrop-blur-md rounded-full flex items-center justify-center pl-1 border border-white/30 text-white shadow-2xl transition-transform hover:scale-110">
                <span class="material-symbols-outlined text-5xl fill">play_arrow</span>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-black/90 to-transparent">
            <div class="h-1 bg-white/30 rounded-full mb-4 cursor-pointer">
                <div class="h-full bg-primary w-1/3 rounded-full relative">
                    <div class="absolute right-0 top-1/2 -translate-y-1/2 size-3 bg-white rounded-full shadow"></div>
                </div>
            </div>
            <div class="flex justify-between items-center text-white">
                <div class="flex items-center gap-4">
                    <span class="material-symbols-outlined cursor-pointer hover:text-primary">play_arrow</span>
                    <span class="material-symbols-outlined cursor-pointer hover:text-primary">volume_up</span>
                    <span class="text-sm font-medium">12:34 / 45:00</span>
                </div>
                <div class="flex items-center gap-4">
                    <span class="material-symbols-outlined cursor-pointer hover:text-primary">settings</span>
                    <span class="material-symbols-outlined cursor-pointer hover:text-primary">fullscreen</span>
                </div>
            </div>
        </div>
    `;
    }

    // Function to download PowerPoint
    function downloadPowerPoint(courseId, pptxUrl, lessonTitle, buttonElement) {
        if (!pptxUrl) {
            showToast('PowerPoint not available for this lesson', 'error');
            return;
        }

        // Save original button content
        const originalContent = buttonElement.innerHTML;

        // Show loading state
        buttonElement.disabled = true;
        buttonElement.innerHTML = `
        <span class="material-symbols-outlined text-sm animate-spin">refresh</span>
        Downloading...
    `;

        // Create download link
        fetch(pptxUrl)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Download failed');
                }
                return response.blob();
            })
            .then(blob => {
                // Create temporary download link
                const url = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.style.display = 'none';
                a.href = url;

                // Clean filename
                const cleanTitle = lessonTitle.replace(/[^a-z0-9]/gi, '_').toLowerCase();
                a.download = `${cleanTitle}_slides.pptx`;

                // Trigger download
                document.body.appendChild(a);
                a.click();

                // Cleanup
                window.URL.revokeObjectURL(url);
                document.body.removeChild(a);

                // Reset button
                buttonElement.disabled = false;
                buttonElement.innerHTML = originalContent;

                showToast('PowerPoint downloaded successfully!', 'success');
            })
            .catch(error => {
                console.error('Error:', error);
                buttonElement.disabled = false;
                buttonElement.innerHTML = originalContent;
                showToast('Failed to download PowerPoint. Please try again.', 'error');
            });
    }

    // Toast notification function
    function showToast(message, type = 'info') {
        const toastContainer = document.getElementById('toast-container');

        const colors = {
            success: 'bg-green-500',
            error: 'bg-red-500',
            info: 'bg-blue-500',
            warning: 'bg-yellow-500'
        };

        const icons = {
            success: 'check_circle',
            error: 'error',
            info: 'info',
            warning: 'warning'
        };

        const toast = document.createElement('div');
        toast.className = `${colors[type]} text-white px-6 py-3 rounded-lg shadow-lg flex items-center gap-3 animate-slide-in-right max-w-md`;
        toast.innerHTML = `
        <span class="material-symbols-outlined">${icons[type]}</span>
        <span class="flex-1">${message}</span>
        <button onclick="this.parentElement.remove()" class="hover:bg-white/20 rounded p-1 transition-colors">
            <span class="material-symbols-outlined text-sm">close</span>
        </button>
    `;

        toastContainer.appendChild(toast);

        // Auto remove after 4 seconds
        setTimeout(() => {
            toast.style.animation = 'slide-out-right 0.3s ease-out';
            setTimeout(() => toast.remove(), 300);
        }, 4000);
    }
</script>

<style>
    @keyframes slide-in-right {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    @keyframes slide-out-right {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(100%);
            opacity: 0;
        }
    }

    .animate-slide-in-right {
        animation: slide-in-right 0.3s ease-out;
    }

    .animate-spin {
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        from {
            transform: rotate(0deg);
        }
        to {
            transform: rotate(360deg);
        }
    }
</style>
@endsection