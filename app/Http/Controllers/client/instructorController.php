<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\AchievementsModel;
use App\Models\BooksModel;
use App\Models\coursesModel;
use App\Models\InstructorModel;
use Illuminate\Http\Request;

class instructorController extends Controller
{
    public function index()
    {
        $instructor= InstructorModel::first();
        $achievements = AchievementsModel::where('instructor_id', $instructor->id)->get();
        $courses=coursesModel::all();
        $books=BooksModel::join('authors','books.author','=','authors.id')->join('book_categories','books.category_id','=','book_categories.id')->select('books.*','authors.full_name as author')->get();
        return view('client.instructor',compact('instructor','achievements','courses','books'));
    }
}
