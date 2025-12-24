<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\bookCategoriesModel;
use App\Models\BooksModel;
use Illuminate\Http\Request;

class booksController extends Controller
{
    public function index()
    {
        $books_categories = bookCategoriesModel::all();
        $books=BooksModel::join('authors','books.author','=','authors.id')->join('book_categories','books.category_id','=','book_categories.id')->select('books.*','authors.full_name as author')->get();
        $top_book=BooksModel::join('authors','books.author','=','authors.id')->join('book_categories','books.category_id','=','book_categories.id')->select('books.*','authors.full_name as author')->limit(1)->first();
        return view('client.book_listings', compact('books_categories','books','top_book'));
    }
    public function bookSummary(Request $request,$id)
    {
        $book_details=BooksModel::join('authors','books.author','=','authors.id')->join('book_categories','books.category_id','=','book_categories.id')->select('books.*','authors.full_name as author','authors.biography as author_bio','book_categories.category_name as category')->where('books.id',$id)->first();
        $similar_books=BooksModel::join('authors','books.author','=','authors.id')->select('books.id','books.title as title','authors.full_name as author')->where('books.category_id',$book_details->category_id)->where('books.id','!=',$id)->limit(3)->get();
        return view('client.books',compact('book_details','similar_books'));
    }
}
