<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CombosModel;
use App\Models\ShopCategoriesModel;
use App\Models\ShopItemsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ShopController extends Controller
{
    // =========================================================
    // SHOP ITEMS
    // =========================================================

    public function index()
    {
        $data['products'] = ShopItemsModel::join('shop_categories', 'shop_categories.id', '=', 'shop_items.category_id')
            ->select('shop_items.*', 'shop_categories.name as category_name')
            ->get();
        return view('admin.shop.index', compact('data'));
    }

    public function add()
    {
        $data['categories'] = ShopCategoriesModel::all();
        return view('admin.shop.add', compact('data'));
    }

    public function insert(Request $request)
    {
        $request->validate([
            'name'                => 'required|string|max:255',
            'description'         => 'nullable|string',
            'price'               => 'required|numeric|min:0',
            'category_id'         => 'required|exists:shop_categories,id',
            'image'               => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'discount_percentage' => 'nullable|numeric|min:0|max:100',
        ]);

        $item = new ShopItemsModel();
        $item->name                = $request->input('name');
        $item->description         = $request->input('description');
        $item->price               = $request->input('price');
        $item->category_id         = $request->input('category_id');
        $item->discount_percentage = $request->input('discount_percentage', 0);

        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images/shop'), $imageName);
            $item->image = 'images/shop/' . $imageName;
        }

        $item->save();

        return redirect()->route('admin.shop.index')->with('success', 'Shop item added successfully!');
    }

    public function edit($id)
    {
        $data['item']       = ShopItemsModel::findOrFail($id);
        $data['categories'] = ShopCategoriesModel::all();
        return view('admin.shop.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'                => 'required|string|max:255',
            'description'         => 'nullable|string',
            'price'               => 'required|numeric|min:0',
            'category_id'         => 'required|exists:shop_categories,id',
            'image'               => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'discount_percentage' => 'nullable|numeric|min:0|max:100',
        ]);

        $item = ShopItemsModel::findOrFail($id);
        $item->name                = $request->input('name');
        $item->description         = $request->input('description');
        $item->price               = $request->input('price');
        $item->category_id         = $request->input('category_id');
        $item->discount_percentage = $request->input('discount_percentage', 0);

        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images/shop'), $imageName);
            $item->image = 'images/shop/' . $imageName;
        }

        $item->save();

        return redirect()->route('admin.shop.index')->with('success', 'Shop item updated successfully!');
    }

    public function delete($id)
    {
        $item = ShopItemsModel::findOrFail($id);
        $item->delete();
        return redirect()->route('admin.shop.index')->with('success', 'Shop item deleted successfully!');
    }

    // =========================================================
    // SHOP CATEGORIES
    // =========================================================

    public function shopCategories()
    {
        $data['categories'] = ShopCategoriesModel::withCount('items')->get();
        return view('admin.shop.categories', compact('data'));
    }

    public function addCategory()
    {
        return view('admin.shop.add_category');
    }

    public function insertCategory(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category              = new ShopCategoriesModel();
        $category->name        = $request->input('name');
        $category->description = $request->input('description');
        $category->save();

        return redirect()->route('admin.shop.categories')->with('success', 'Category added successfully!');
    }

    public function editCategory($id)
    {
        $data['category'] = ShopCategoriesModel::findOrFail($id);
        return view('admin.shop.edit_category', compact('data'));
    }

    public function updateCategory(Request $request, $id)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category              = ShopCategoriesModel::findOrFail($id);
        $category->name        = $request->input('name');
        $category->description = $request->input('description');
        $category->save();

        return redirect()->route('admin.shop.categories')->with('success', 'Category updated successfully!');
    }

    public function deleteCategory($id)
    {
        $category = ShopCategoriesModel::findOrFail($id);
        $category->delete();
        return redirect()->route('admin.shop.categories')->with('success', 'Category deleted successfully!');
    }

    // =========================================================
    // COMBOS
    // =========================================================

    public function combos()
    {
        $data['combos'] = CombosModel::all();

        // Decode items_included JSON for each combo and attach item names
        $allItems = ShopItemsModel::all()->keyBy('id');
        foreach ($data['combos'] as $combo) {
            $ids = json_decode($combo->items_included, true) ?? [];
            $combo->item_names = collect($ids)->map(fn($id) => $allItems->get($id)?->name ?? 'Unknown')->implode(', ');
            $combo->item_count = count($ids);
        }

        return view('admin.shop.combos', compact('data'));
    }

    public function addCombo()
    {
        $data['items'] = ShopItemsModel::join('shop_categories', 'shop_categories.id', '=', 'shop_items.category_id')
            ->select('shop_items.*', 'shop_categories.name as category_name')
            ->orderBy('shop_items.name')
            ->get();
        return view('admin.shop.add_combo', compact('data'));
    }

    public function insertCombo(Request $request)
    {
        $request->validate([
            'name'                => 'required|string|max:255',
            'description'         => 'nullable|string',
            'price'               => 'required|numeric|min:0',
            'items_included'      => 'required|array|min:1',
            'items_included.*'    => 'exists:shop_items,id',
            'image'               => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'discount_percentage' => 'nullable|numeric|min:0|max:100',
        ]);

        $combo                    = new CombosModel();
        $combo->name              = $request->input('name');
        $combo->description       = $request->input('description');
        $combo->price             = $request->input('price');
        $combo->items_included    = json_encode($request->input('items_included'));
        $combo->discount_percentage = $request->input('discount_percentage', 0);

        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images/combos'), $imageName);
            $combo->image = 'images/combos/' . $imageName;
        }

        $combo->save();

        return redirect()->route('admin.shop.combos')->with('success', 'Combo created successfully!');
    }

    public function editCombo($id)
    {
        $data['combo'] = CombosModel::findOrFail($id);
        $data['items'] = ShopItemsModel::join('shop_categories', 'shop_categories.id', '=', 'shop_items.category_id')
            ->select('shop_items.*', 'shop_categories.name as category_name')
            ->orderBy('shop_items.name')
            ->get();
        $data['selected_items'] = json_decode($data['combo']->items_included, true) ?? [];
        return view('admin.shop.edit_combo', compact('data'));
    }

    public function updateCombo(Request $request, $id)
    {
        $request->validate([
            'name'                => 'required|string|max:255',
            'description'         => 'nullable|string',
            'price'               => 'required|numeric|min:0',
            'items_included'      => 'required|array|min:1',
            'items_included.*'    => 'exists:shop_items,id',
            'image'               => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'discount_percentage' => 'nullable|numeric|min:0|max:100',
        ]);

        $combo                    = CombosModel::findOrFail($id);
        $combo->name              = $request->input('name');
        $combo->description       = $request->input('description');
        $combo->price             = $request->input('price');
        $combo->items_included    = json_encode($request->input('items_included'));
        $combo->discount_percentage = $request->input('discount_percentage', 0);

        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images/combos'), $imageName);
            $combo->image = 'images/combos/' . $imageName;
        }

        $combo->save();

        return redirect()->route('admin.shop.combos')->with('success', 'Combo updated successfully!');
    }

    public function deleteCombo($id)
    {
        $combo = CombosModel::findOrFail($id);
        $combo->delete();
        return redirect()->route('admin.shop.combos')->with('success', 'Combo deleted successfully!');
    }
}
