<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\CombosModel;
use App\Models\ShopCategoriesModel;
use App\Models\ShopItemsModel;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        // ── Combos (top hero section) ────────────────────────────────────────────
        $combos     = CombosModel::all();
        $allItems   = ShopItemsModel::all()->keyBy('id');

        foreach ($combos as $combo) {
            $ids = json_decode($combo->items_included, true) ?? [];
            $combo->item_names = collect($ids)
                ->map(fn($id) => $allItems->get($id)?->name ?? 'Unknown')
                ->implode(', ');
            $combo->item_count = count($ids);
        }

        // ── Categories for filter sidebar ────────────────────────────────────────
        $categories = ShopCategoriesModel::withCount('items')->get();

        // ── Filter state ─────────────────────────────────────────────────────────
        $selectedCategory = $request->input('category');     // category ID or null
        $maxPrice         = $request->input('max_price');    // numeric or null
        $search           = $request->input('search');

        // ── Products query ───────────────────────────────────────────────────────
        $query = ShopItemsModel::join('shop_categories', 'shop_categories.id', '=', 'shop_items.category_id')
            ->select('shop_items.*', 'shop_categories.name as category_name');

        if ($selectedCategory) {
            $query->where('shop_items.category_id', $selectedCategory);
        }
        if ($maxPrice) {
            $query->where('shop_items.price', '<=', $maxPrice);
        }
        if ($search) {
            $query->where('shop_items.name', 'like', "%{$search}%");
        }

        $products = $query->orderBy('shop_categories.name')->orderBy('shop_items.name')->get();

        // ── Group products by category (for the carousels) ───────────────────────
        $productsByCategory = $products->groupBy('category_name');

        // ── Price range for the range slider ─────────────────────────────────────
        $maxProductPrice = ShopItemsModel::max('price') ?? 10000;

        return view('client.shop', compact(
            'combos',
            'categories',
            'productsByCategory',
            'maxProductPrice',
            'selectedCategory',
            'maxPrice',
            'search'
        ));
    }
}
