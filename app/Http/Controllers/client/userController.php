<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\courseMaterialsModel;
use App\Models\courseProgressModel;
use App\Models\coursesModel;
use App\Models\InstructorModel;
use App\Models\LessonsModel;
use App\Models\salesDetailsModel;
use App\Models\salesModel;
use App\Models\userDetailsModel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class userController extends Controller
{
    public function myProfile()
    {
        $user_id = session('user_id');
        $user_data = userDetailsModel::where('id', $user_id)->first();
        $orders = salesModel::where('user_id', $user_id)->get();
        $purchases = salesDetailsModel::whereHas('sale', function ($query) use ($user_id) {
            $query->where('user_id', $user_id);
        })
            ->with(['book', 'course'])
            ->get();

        $myBooks = $purchases->where('item_type', 'book');
        $myCourses = $purchases->where('item_type', 'course');
        return view('client.user_profile', compact('user_data', 'orders', 'myBooks', 'myCourses'));
    }
    public function downloadReceipt($id)
    {
        $order = salesModel::join('sales_details', 'sales_details.sale_id', 'sales.id')->where('user_id', session('user_id'))->findOrFail($id);

        $order_details = salesDetailsModel::where('sale_id', $id)
            ->with(['book', 'course']) // Eager load both
            ->get()
            ->map(function ($detail) {
                // Dynamically assign the name based on the type
                if ($detail->item_type === 'book') {
                    $detail->display_name = $detail->book->title ?? 'Unknown Book';
                } elseif ($detail->item_type === 'course') {
                    $detail->display_name = $detail->course->course_name ?? 'Unknown Course';
                } else {
                    $detail->display_name = "Item #{$detail->item_id}";
                }
                return $detail;
            });



        // This points to a simple blade file formatted as a receipt
        $pdf = Pdf::loadView('pdf.receipt', compact('order', 'order_details'));

        return $pdf->download('Receipt-' . $order->receipt_number . '.pdf');
    }
    public function progressWithCourse(Request $request, $id)
    {
        $course_details = coursesModel::join('course_categories', 'course_categories.id', 'courses.category_id')
            ->select('courses.*', 'course_categories.category_name')
            ->where('courses.id', $id)
            ->first();

        $instructor = InstructorModel::first();
        $course_lessons = LessonsModel::  // Changed from 'courseMaterialsModel'
            where('course_id', $course_details->id)
            ->orderBy('lesson_number')
            ->get();
        $material_count = courseMaterialsModel::where('course_id', $id)->count();
        $all_courses_count = coursesModel::count();
        return view('client.course_progress', compact('course_details', 'instructor', 'course_lessons', 'material_count', 'all_courses_count'));
    }
    public function updateProgress(Request $request)
    {
        // Use updateOrCreate to either update existing progress or create new
        courseProgressModel::updateOrCreate(
            [
                'user_id' => session('user_id'),
                'course_id' => $request->course_id,
            ],
            [
                'lesson_number' => $request->lesson_id, // or lesson sequence
                'status' => 0,
                'updated_at' => now()
            ]
        );

        return response()->json(['success' => true]);
    }
    public function fetchVideoUrl(Request $request,$course_id,$lesson_number){
        $course_data=courseMaterialsModel::select('material_url')->where('course_id',$course_id)->where('lesson_number',$lesson_number)->where('document_type','video')->first();
        return response()->json([
            'success' => true,
            'video_url' => $course_data->material_url,
            'lesson_title' => $course_data->title
        ]);   
     }
    public function fetchPptxUrl(Request $request,$course_id,$lesson_number){
        $course_data=courseMaterialsModel::select('material_url')->where('course_id',$course_id)->where('lesson_number',$lesson_number)->where('document_type','pptx')->first();
        return response()->json([
            'success' => true,
            'pptx_url' => $course_data->material_url,
            'lesson_title' => $course_data->title
        ]);      }
}
