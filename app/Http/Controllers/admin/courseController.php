<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\courseCategoryModel;
use App\Models\courseMaterialsModel;
use App\Models\coursesModel;
use App\Models\LessonsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class courseController extends Controller
{
    public function index()
    {
        $data['courses'] = coursesModel::join('course_categories', 'courses.category_id', '=', 'course_categories.id')->select('course_categories.category_name','courses.*')->get();
        return view('admin.courses.index', compact('data'));
    }

    public function addCourse()
    {
        $data['course_categories'] = courseCategoryModel::all();
        return view('admin.courses.add', compact('data'));
    }
    public function insertCourse(Request $request)
    {
        // 1. Validation
        $request->validate([
            'course_name'     => 'required|string|max:255',
            'category'        => 'required|integer',
            'duration'        => 'required|integer',
            'duration_units'  => 'required|string',
            'description'     => 'required|string',
            'no_of_lessons'   => 'required|integer|min:1|max:60',
            'access'          => 'required|in:free,premium',
            'price'           => 'required_if:access,premium|nullable|numeric|min:0',
            'discount'        => 'nullable|numeric|min:0|max:100',
            'cover_image'     => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'lessons.*.title' => 'required|string|max:255',
            'lessons.*.description' => 'nullable|string',
            'lessons.*.video' => 'nullable|file|mimes:mp4,mov,avi,wmv|max:102400',
            'lessons.*.ppt'   => 'nullable|file|mimes:ppt,pptx,pdf|max:20480',
        ]);

        // 2. Initialize Course Model
        $course = new coursesModel();
        $course->course_name = $request->course_name;
        $course->category_id = $request->category;
        $course->course_duration = $request->duration;
        $course->duration_unit = $request->duration_units;
        $course->course_description = $request->description;
        $course->no_of_lessons = $request->no_of_lessons;
        $course->status = 1;

        // 3. Handle Access/Pricing Logic
        if ($request->access === 'premium') {
            $course->pricing = $request->price;
            $course->discount = $request->discount ?? 0;
        } else {
            $course->pricing = 0;
            $course->discount = 0;
        }

        // 4. Handle Cover Image Upload
        if ($request->hasFile('cover_image')) {
            $file = $request->file('cover_image');
            $filename = time() . '_' . $file->getClientOriginalName();
            // Stores in storage/app/public/assets/courses/course_images
            $path = $file->storeAs('assets/courses/course_images', $filename, 'public');
            $course->cover_image = Storage::url($path);
        }

        $course->save();

        // 5. Handle Dynamic Lessons
        if ($request->has('lessons')) {
            // Loop through the text data (titles/descriptions)
            foreach ($request->lessons as $index => $lessonData) {

                $lesson = new LessonsModel();
                $lesson->course_id = $course->id;
                $lesson->lesson_title = $lessonData['title'] ?? 'Untitled Lesson';
                $lesson->description = $lessonData['description'] ?? null;
                $lesson->lesson_number = $index;
                $lesson->save();

                // Handle Files (found in $request->file('lessons') matching the index)
                $lessonFiles = $request->file("lessons.$index");

                // Store Video if exists
                if (isset($lessonFiles['video'])) {
                    $file = $lessonFiles['video'];
                    $ext = $file->getClientOriginalExtension();
                    $filename = time() . '_v_' . $index . '.' . $ext;
                    $path = $file->storeAs('assets/courses/videos', $filename, 'public');

                    $course_material = new courseMaterialsModel();
                    $course_material->course_id = $course->id;
                    // $course_material->lesson_id = $lesson->id; // Linked to the specific lesson
                    $course_material->lesson_number = $index;
                    $course_material->material_url = Storage::url($path);
                    $course_material->document_type = 'video';
                    $course_material->save();
                }

                // Store PPT if exists
                if (isset($lessonFiles['ppt'])) {
                    $file = $lessonFiles['ppt'];
                    $ext = $file->getClientOriginalExtension();
                    $filename = time() . '_d_' . $index . '.' . $ext;
                    $path = $file->storeAs('assets/courses/documents', $filename, 'public');

                    $course_material = new courseMaterialsModel();
                    $course_material->course_id = $course->id;
                    // $course_material->lesson_id = $lesson->id;
                    $course_material->lesson_number = $index;
                    $course_material->material_url = Storage::url($path);
                    $course_material->document_type = $ext;
                    $course_material->save();
                }
            }
        }

        return redirect()->to('/admin_courses')->with('success', 'Course and ' . $request->no_of_lessons . ' lessons published successfully.');
    }
    public function editCourse($id)
    {
        // Find course or 404
        $course = coursesModel::findOrFail($id);

        // Get Categories
        $data['course_categories'] = courseCategoryModel::all();
        $data['course'] = $course;

        // Get existing lessons and group materials by lesson_number for the JS
        $data['lessons'] = LessonsModel::where('course_id', $id)->orderBy('lesson_number', 'asc')->get();

        // This allows the JS to see what files are already there
        $data['materials'] = courseMaterialsModel::where('course_id', $id)
            ->get()
            ->groupBy('lesson_number');

        return view('admin.courses.edit', compact('data'));
    }
    public function updateCourse(Request $request, $id)
    {
        // 1. Validation (Matches Blade names)
        $request->validate([
            'course_name'     => 'required|string|max:255',
            'category'        => 'required|integer',
            'duration'        => 'required|integer',
            'duration_units'  => 'required|string',
            'description'     => 'required|string',
            'no_of_lessons'   => 'required|integer|min:1|max:60',
            'access'          => 'required|in:free,premium',
            'price'           => 'required_if:access,premium|nullable|numeric|min:0',
            'discount'        => 'nullable|numeric|min:0|max:100',
            'cover_image'     => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'lessons.*.title' => 'required|string|max:255',
        ]);

        // 2. Find and Update Course
        $course = coursesModel::findOrFail($id);
        $course->course_name = $request->course_name;
        $course->category_id = $request->category;
        $course->course_duration = $request->duration;
        $course->duration_unit = $request->duration_units;
        $course->course_description = $request->description;
        $course->no_of_lessons = $request->no_of_lessons;

        // 3. Pricing Logic
        if ($request->access === 'premium') {
            $course->pricing = $request->price;
            $course->discount = $request->discount ?? 0;
        } else {
            $course->pricing = 0;
            $course->discount = 0;
        }

        // 4. Handle Cover Image
        if ($request->hasFile('cover_image')) {
            // Delete old image if it exists to save space
            if ($course->cover_image) {
                $oldPath = str_replace('/storage/', '', $course->cover_image);
                Storage::disk('public')->delete($oldPath);
            }

            $path = $request->file('cover_image')->store('assets/courses/course_images', 'public');
            $course->cover_image = Storage::url($path);
        }
        $course->save();

        // 5. Handle Lessons (Update existing or Create new)
        if ($request->has('lessons')) {
            foreach ($request->lessons as $index => $lessonData) {

                // updateOrCreate matches by course_id and lesson_number
                $lesson = LessonsModel::updateOrCreate(
                    ['course_id' => $course->id, 'lesson_number' => $index],
                    [
                        'lesson_title' => $lessonData['title'],
                        'description'  => $lessonData['description'] ?? null
                    ]
                );

                // Handle Files (Check for files in the specific index)
                $lessonFiles = $request->file("lessons.$index");

                if (isset($lessonFiles['video'])) {
                    $this->saveMaterial($course->id, $lesson->id, $index, $lessonFiles['video'], 'videos');
                }

                if (isset($lessonFiles['ppt'])) {
                    $this->saveMaterial($course->id, $lesson->id, $index, $lessonFiles['ppt'], 'documents');
                }
            }
        }

        return redirect()->to('/admin_courses')->with('success', 'Course updated successfully.');
    }

    /**
     * Helper function to handle repeated material saving logic
     */
    private function saveMaterial($courseId, $lessonId, $index, $file, $folder)
    {
        $ext = $file->getClientOriginalExtension();
        // Unique name to avoid cache/overwrite issues
        $filename = time() . '_' . $index . '_' . $folder . '.' . $ext;
        $path = $file->storeAs('assets/courses/' . $folder, $filename, 'public');

        // Find old material for this lesson and type to delete it
        $typeIdentifier = ($folder === 'videos') ? 'video' : $ext;
        $oldMaterial = courseMaterialsModel::where('lesson_number', $lessonId)
            ->where('document_type', $folder === 'videos' ? 'video' : $ext)
            ->first();

        if ($oldMaterial) {
            $oldFilePath = str_replace('/storage/', '', $oldMaterial->material_url);
            Storage::disk('public')->delete($oldFilePath);
            $oldMaterial->delete();
        }

        $material = new courseMaterialsModel();
        $material->course_id = $courseId;
        // $material->lesson_id = $lessonId;
        $material->lesson_number = $index;
        $material->material_url = Storage::url($path);
        $material->document_type = $folder === 'videos' ? 'video' : $ext;
        $material->save();
    }



    public function deleteCourse($id)
    {
        $course = coursesModel::findOrFail($id);
        $course->delete();
        return redirect()->to('/admin_courses')->with('success', 'Course deleted successfully.');
    }


    public function adminCourseCategories()
    {
        $data['course_categories'] = courseCategoryModel::all();
        return view('admin.courses.course_categories.index', compact('data'));
    }
    public function addCourseCategories()
    {
        return view('admin.courses.course_categories.add');
    }
    public function insertCourseCategory(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
        ]);
        $courseCategory = new courseCategoryModel();
        $courseCategory->category_name = $request->category_name;
        // $courseCategory->description = $request->description;
        $courseCategory->status = 1;
        $courseCategory->save();
        return redirect()->to('/admin_course_categories')->with('success', 'Course category added successfully.');
    }
    public function editCourseCategories($id)
    {
        $data['course_category'] = courseCategoryModel::findOrFail($id);
        return view('admin.courses.course_categories.edit', compact('data'));
    }
    public function updateCourseCategory(Request $request, $id)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
        ]);
        $courseCategory = courseCategoryModel::findOrFail($id);
        $courseCategory->category_name = $request->category_name;
        // $courseCategory->description = $request->description;
        $courseCategory->save();
        return redirect()->to('/admin_course_categories')->with('success', 'Course category updated successfully.');
    }
    public function deleteCourseCategory($id)
    {
        $courseCategory = courseCategoryModel::findOrFail($id);
        $courseCategory->delete();
        return redirect()->to('/admin_course_categories')->with('success', 'Course category deleted successfully.');
    }
}
