<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\CombosModel;
use App\Models\courseMaterialsModel;
use App\Models\courseProgressModel;
use App\Models\coursesModel;
use App\Models\InstructorModel;
use App\Models\LessonsModel;
use App\Models\salesDetailsModel;
use App\Models\salesModel;
use App\Models\ShopItemsModel;
use App\Models\userDetailsModel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class userController extends Controller
{
    public function myProfile()
    {
        $user_id  = session('user_id');
        $user_data = userDetailsModel::where('id', $user_id)->first();
        $orders   = salesModel::where('user_id', $user_id)->latest()->get();

        // All purchase detail lines for this user, with every possible relation loaded
        $purchases = salesDetailsModel::whereHas('sale', function ($q) use ($user_id) {
                $q->where('user_id', $user_id);
            })
            ->with(['book', 'course', 'shopItem', 'combo'])
            ->get();

        $myBooks     = $purchases->where('item_type', 'book');
        $myCourses   = $purchases->where('item_type', 'course');
        $myShopItems = $purchases->where('item_type', 'shop_item');
        $myCombos    = $purchases->where('item_type', 'combo');

        return view('client.user_profile', compact(
            'user_data',
            'orders',
            'myBooks',
            'myCourses',
            'myShopItems',
            'myCombos'
        ));
    }
    public function downloadReceipt($id)
    {
        $order = salesModel::join('sales_details', 'sales_details.sale_id', 'sales.id')
            ->where('user_id', session('user_id'))
            ->findOrFail($id);

        $order_details = salesDetailsModel::where('sale_id', $id)
            ->with(['book', 'course', 'shopItem', 'combo'])
            ->get()
            ->map(function ($detail) {
                $detail->display_name = match ($detail->item_type) {
                    'book'      => $detail->book?->title       ?? 'Unknown Book',
                    'course'    => $detail->course?->course_name ?? 'Unknown Course',
                    'shop_item' => $detail->shopItem?->name     ?? 'Unknown Shop Item',
                    'combo'     => $detail->combo?->name        ?? 'Unknown Combo',
                    default     => "Item #{$detail->item_id}",
                };
                return $detail;
            });

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
        // dd(session('user_id'));
        $course_progress = courseProgressModel::where('user_id', session('user_id'))->where('course_id', $id)->first();
        // dd($course_progress);
        return view('client.course_progress', compact('course_details', 'instructor', 'course_lessons', 'material_count', 'all_courses_count', 'course_progress'));
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
        $course_data=courseMaterialsModel::select('material_url')->where('course_id',$course_id)->where('lesson_number',$lesson_number)->whereIn('document_type',['pptx','pdf'])->first();
        return response()->json([
            'success' => true,
            'pptx_url' => $course_data->material_url,
            'lesson_title' => $course_data->title
        ]);      }
}
