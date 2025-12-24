<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\authorsModel;
use App\Models\bookCategoriesModel;
use App\Models\bookMaterialsModel;
use App\Models\BooksModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class booksController extends Controller
{
    //
    public function index()
    {
        $data['books'] = BooksModel::join('book_categories', 'books.category_id', '=', 'book_categories.id')
        ->join('authors', 'books.author', '=', 'authors.id')
            ->select('books.*', 'book_categories.category_name', 'authors.full_name as author')
            ->get();
        return view('admin.books.index',compact('data'));
    }
    public function addBook()
    {
        $data['book_categories'] = bookCategoriesModel::all();
        $data['authors'] = authorsModel::select('full_name', 'id')->get();
        return view('admin.books.add', compact('data'));
    }
    public function insertBook(Request $request)
    {
        // Validate the request
        $request->validate([
            'book_name'    => 'required|string|max:255',
            'category'     => 'required|exists:book_categories,id',
            'author_id'  => 'required|exists:authors,id',
            'description'  => 'nullable|string',
            'cover_image'  => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'sub_title'    => 'nullable|string|max:255',
            'isbn'         => 'nullable|string|max:20',

            // Conditional Access Logic
            'access'       => 'required|in:free,premium',
            'price'        => 'required_if:access,premium|nullable|numeric|min:0.01',
            'discount'     => 'nullable|numeric|min:0|max:100',

            // File Validation (Updated to 50MB to match your UI)
            'book_file'    => 'nullable|file|mimes:pdf,epub|max:51200',
        ]);
        $book = new BooksModel();
        $book->title = $request->book_name;
        $book->subtitle = $request->sub_title;
        $book->isbn = $request->isbn;
        $book->category_id = $request->category;
        $book->author = $request->author_id;
        $book->synopsis = $request->description;
        if($request->access=='free'){
            $book->pricing = 0;
            $book->discount = 0;

        }else{
            $book->pricing = $request->price;
        }
        $book->discount = $request->discount;
        $book->created_at = now();
        $book->status = 0;
        // Handle cover image upload
        if ($request->hasFile('cover_image')) {
            $file = $request->file('cover_image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $filepath = '/assets/books/cover_images/' . $filename;
            $path = Storage::disk('public')->put($filepath, file_get_contents($file));
            $path = Storage::url($filepath);
            $book->image = $path;
        }
        $book->save();

        $book_material = new bookMaterialsModel();
        if ($request->hasFile('book_file')) {
            $file = $request->file('book_file');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $filepath = '/assets/books/files/' . $filename;
            $path = Storage::disk('public')->put($filepath, file_get_contents($file));
            $path = Storage::url($filepath);
            $book_material->book_url = $path;
            if ($ext == 'pdf') {
                $book_material->document_type = 'pdf';
            } elseif ($ext == 'epub') {
                $book->document_type = 'epub';
            }
        }

        $book_material->book_id = $book->id;
        $book_material->created_at = now();
        $book_material->status = 0;
        $book_material->save();
        // Redirect back with a success message
        return redirect()->to('/admin_books')->with('success', 'Book added successfully!');
    }
    public function editBook($id)
    {
        $data['book'] = BooksModel::find($id);
        $data['book_categories'] = bookCategoriesModel::all();
        $data['authors'] = authorsModel::select('full_name', 'id')->get();
        return view('admin.books.edit', compact('data'));
    }
    public function updateBook(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'book_name'    => 'required|string|max:255',
            'category'     => 'required|exists:book_categories,id',
            'author_id'  => 'required|exists:authors,id',
            'description'  => 'nullable|string',
            'cover_image'  => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'sub_title'    => 'nullable|string|max:255',
            'isbn'         => 'nullable|string|max:20',

            // Conditional Access Logic
            'access'       => 'required|in:free,premium',
            'price'        => 'required_if:access,premium|nullable|numeric|min:0.01',
            'discount'     => 'nullable|numeric|min:0|max:100',

            // File Validation (Updated to 50MB to match your UI)
            'book_file'    => 'nullable|file|mimes:pdf,epub|max:51200',
        ]);
        $book = BooksModel::find($id);
        $book->title = $request->book_name;
        $book->category_id = $request->category;
        $book->author = $request->author_id;
        $book->synopsis = $request->description;
        if($request->access=='free'){
            $book->pricing = 0;
            $book->discount = 0;

        }else{
            $book->pricing = $request->price;
        }
        $book->discount = $request->discount;
        $book->updated_at = now();
        // Handle cover image upload
        if ($request->hasFile('cover_image')) {
            $file = $request->file('cover_image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $filepath = '/assets/books/cover_images/' . $filename;
            $path = Storage::disk('public')->put($filepath, file_get_contents($file));
            $path = Storage::url($filepath);
            $book->image = $path;
        }
        $book->save();
                $book_material = new bookMaterialsModel();
        if ($request->hasFile('book_file')) {
            $file = $request->file('book_file');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $filepath = '/assets/books/files/' . $filename;
            $path = Storage::disk('public')->put($filepath, file_get_contents($file));
            $path = Storage::url($filepath);
            $book_material->book_url = $path;
            if ($ext == 'pdf') {
                $book_material->document_type = 'pdf';
            } elseif ($ext == 'epub') {
                $book->document_type = 'epub';
            }
                    $book_material->book_id = $book->id;
        $book_material->created_at = now();
        $book_material->status = 0;
        $book_material->save();

        }



        return redirect()->to('/admin_books')->with('success', 'Book updated successfully!');
    }

    public function deleteBook($id)
    {
        // Find the book and delete it
        $book = BooksModel::find($id);
        if ($book) {
            $book->delete();
            return redirect()->back()->with('success', 'Book deleted successfully!');
        } else {
            return redirect()->back()->with('error', 'Book not found.');
        }
    }




    public function bookCategories()
    {
        $data['book_categories'] = bookCategoriesModel::all();

        return view('admin.books.book_categories.index', compact('data'));
    }
    public function addBookCategories()
    {
        return view('admin.books.book_categories.add');
    }
    public function insertBookCategory(Request $request)
    {
        // Validate the request
        $request->validate([
            'category_name' => 'required|string|max:255',
        ]);

        // Insert the new book category into the database
        $bookCategory = new bookCategoriesModel();
        $bookCategory->category_name = $request->category_name;
        $bookCategory->created_at = now();
        $bookCategory->status = 0;
        $bookCategory->save();

        // Redirect back with a success message
        return redirect()->to('/admin_book_categories')->with('success', 'Book category added successfully!');
    }
    public function editBookCategories($id)
    {
        $data['book_category'] = bookCategoriesModel::find($id);
        return view('admin.books.book_categories.edit', compact('data'));
    }
    public function updateBookCategory(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'category_name' => 'required|string|max:255',
        ]);

        // Find the book category and update it
        $bookCategory = bookCategoriesModel::find($id);
        $bookCategory->category_name = $request->category_name;
        $bookCategory->updated_at = now();
        $bookCategory->save();

        // Redirect back with a success message
        return redirect()->to('/admin_book_categories')->with('success', 'Book category updated successfully!');
    }
    public function deleteBookCategory($id)
    {
        // Find the book category and delete it
        $bookCategory = bookCategoriesModel::find($id);
        if ($bookCategory) {
            $bookCategory->delete();
            return redirect()->back()->with('success', 'Book category deleted successfully!');
        } else {
            return redirect()->back()->with('error', 'Book category not found.');
        }
    }
}
