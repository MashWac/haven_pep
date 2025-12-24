<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\courseCategoryModel;
use App\Models\courseMaterialsModel;
use App\Models\coursesModel;
use App\Models\InstructorModel;
use App\Models\LessonsModel;
use Illuminate\Http\Request;

class coursesController extends Controller
{
    public function index()
    {
        $instructor = InstructorModel::first();
        $coursesCategories = courseCategoryModel::all();
        $top_course = coursesModel::join('course_categories', 'courses.category_id', '=', 'course_categories.id')->select('courses.*', 'course_categories.category_name')->limit(1)->first();
        $courses = coursesModel::join('course_categories', 'courses.category_id', '=', 'course_categories.id')->select('courses.*', 'course_categories.category_name')->get();
        return view('client.course', compact('courses', 'instructor', 'coursesCategories', 'top_course'));
    }
    public function courseDetails(Request $request, $id)
    {
        // Fetch course with its category and lessons (selecting only text fields for lessons)
        $course_details = coursesModel::join('course_categories','course_categories.id','courses.category_id')
        ->select('courses.*', 'course_categories.category_name')
        ->where('courses.id',$id)
        ->first();

        $instructor=InstructorModel::first();
        $course_lessons=LessonsModel::where('course_id',$course_details->id)->get();
        $material_count=courseMaterialsModel::where('course_id',$id)->count();
        $all_courses_count=coursesModel::count();
        return view('client.course_details', compact('course_details','instructor','course_lessons','material_count','all_courses_count'));
    }
}
