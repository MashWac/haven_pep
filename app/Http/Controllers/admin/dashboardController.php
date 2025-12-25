<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\BooksModel;
use App\Models\coursesModel;
use App\Models\salesModel;
use App\Models\userDetailsModel;
use Illuminate\Http\Request;

class dashboardController extends Controller
{
    //
    public function index()
    {
        $books_count = BooksModel::count();
        $courses_count = coursesModel::count();
        $user_count = userDetailsModel::where('user_type', 2)->count();
        $total_sales = salesModel::sum('total_price');
        $recent_sales=salesModel::select('sales.transaction_reference','users_details.full_name','sales.created_at','sales.total_price','sales.id')
        ->join('users_details','users_details.id','sales.user_id')
        ->orderBy('sales.created_at','desc')->limit(10)->get();
        return view('admin.dashboard.index', compact('books_count', 'courses_count', 'user_count', 'total_sales','recent_sales'));
    }
}
