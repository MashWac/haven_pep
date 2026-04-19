<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\BooksModel;
use App\Models\coursesModel;
use App\Models\salesModel;
use App\Models\userDetailsModel;
use App\Models\VisitorIPModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class dashboardController extends Controller
{
    //
    public function index()
    {
        $books_count = BooksModel::count();
        $courses_count = coursesModel::count();
        $user_count = userDetailsModel::where('user_type', 2)->count();
        $total_sales = salesModel::sum('total_price');
        $recent_sales = salesModel::select('sales.transaction_reference', 'users_details.full_name', 'sales.created_at', 'sales.total_price', 'sales.id')
            ->join('users_details', 'users_details.id', 'sales.user_id')
            ->orderBy('sales.created_at', 'desc')->limit(10)->get();
        return view('admin.dashboard.index', compact('books_count', 'courses_count', 'user_count', 'total_sales', 'recent_sales'));
    }

    public function getVisitorStats(Request $request)
    {
        $filter = $request->get('filter', 'daily'); // daily, weekly, monthly
        $data = [];
        $labels = [];
        $driver = DB::getDriverName();

        if ($filter === 'monthly') {
            $periods = 12;
            $format = $driver === 'pgsql' ? "to_char(created_at, 'YYYY-MM')" : 'DATE_FORMAT(created_at, "%Y-%m")';
            $results = VisitorIPModel::select(
                DB::raw("$format as label"),
                DB::raw('COUNT(*) as count')
            )
                ->where('created_at', '>=', Carbon::now()->subMonths($periods))
                ->groupBy('label')
                ->orderBy('label')
                ->get();
        } elseif ($filter === 'weekly') {
            $periods = 12;
            $format = $driver === 'pgsql' ? "to_char(created_at, 'IYYY-\"Week\" IW')" : 'DATE_FORMAT(created_at, "%x-Week %v")';
            $results = VisitorIPModel::select(
                DB::raw("$format as label"),
                DB::raw('COUNT(*) as count')
            )
                ->where('created_at', '>=', Carbon::now()->subWeeks($periods))
                ->groupBy('label')
                ->orderBy('label')
                ->get();
        } else {
            // Default: daily (last 30 days)
            $periods = 30;
            $format = $driver === 'pgsql' ? "to_char(created_at, 'YYYY-MM-DD')" : 'DATE(created_at)';
            $results = VisitorIPModel::select(
                DB::raw("$format as label"),
                DB::raw('COUNT(*) as count')
            )
                ->where('created_at', '>=', Carbon::now()->subDays($periods))
                ->groupBy('label')
                ->orderBy('label')
                ->get();
        }

        foreach ($results as $row) {
            $labels[] = $row->label;
            $data[] = $row->count;
        }

        return response()->json([
            'labels' => $labels,
            'data' => $data,
        ]);
    }
}
