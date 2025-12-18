<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Category;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::with('category')->latest()->paginate(10);
        return view('menus.index', compact('menus'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('menus.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:150',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'is_available' => 'boolean',
        ]);

        Menu::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'is_available' => $request->is_available ?? true,
        ]);

        return redirect()
            ->route('menus.index')
            ->with('success', 'Menu berhasil ditambahkan');
    }

    public function edit(Menu $menu)
    {
        $categories = Category::all();
        return view('menus.edit', compact('menu', 'categories'));
    }

    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:150',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'is_available' => 'boolean',
        ]);

        $menu->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'is_available' => $request->is_available ?? true,
        ]);

        return redirect()
            ->route('menus.index')
            ->with('success', 'Menu berhasil diperbarui');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();

        return redirect()
            ->route('menus.index')
            ->with('success', 'Menu berhasil dihapus');
    }
}
