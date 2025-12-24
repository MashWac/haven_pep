<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\authorsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class adminAuthorsController extends Controller
{
    //
    public function index()
    {
        $data['authors'] = authorsModel::all();
        return view('admin.authors.index', compact('data'));
    }
    public function addAuthor()
    {
        return view('admin.authors.add');
    }
    public function insertAuthor(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
        ]);

        $author = new authorsModel();
        $author->full_name = $request->input('full_name');
        $author->biography = $request->input('biography');
        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $filepath = '/assets/authors/photos' . $filename;
            $path = Storage::disk('public')->put($filepath, file_get_contents($file));
            $path = Storage::url($filepath);
            $author->image = $path;
        }
        $author->save();

        return redirect('/admin_authors')->with('success', 'Author added successfully.');
    }
    public function editAuthor($id)
    {
        $author = authorsModel::findOrFail($id);
        return view('admin.authors.edit', compact('author'));
    }
    public function updateAuthor(Request $request, $id)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
        ]);
        $author = authorsModel::findOrFail($id);
        $author->full_name = $request->input('full_name');
        $author->biography = $request->input('biography');
        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $filepath = '/assets/authors/photos' . $filename;
            $path = Storage::disk('public')->put($filepath, file_get_contents($file));
            $path = Storage::url($filepath);
            $author->image = $path;
        }

        $author->save();
        return redirect('/admin_authors')->with('success', 'Author updated successfully.');
    }
    public function deleteAuthor($id)
    {
        $author = authorsModel::findOrFail($id);
        $author->delete();
        return redirect('/admin_authors')->with('success', 'Author deleted successfully.');
    }
}
