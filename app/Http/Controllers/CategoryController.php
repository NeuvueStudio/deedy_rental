<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $data = [
            'title' => 'Categories | Deedy Admin Panel',
        ];

        $categories = Category::with('parent')->get();

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Category list fetched successfully.',
                'data' => $categories,
            ]);
        }

        return view('admin.pages.categories.index', compact('categories', 'data'));
    }

    public function create()
    {
        $parentCategories = Category::all();
        $data = [
            'title' => 'Categories | Deedy Admin Panel',
        ];
        return view('admin.pages.categories.create_category', compact('parentCategories', 'data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
            'category_image' => 'image|max:2048',
        ]);

        $imagePath = null;

        if ($request->hasFile('category_image')) {
            $imagePath = $request->file('category_image')->store('upload/category_images', 'public');
        }

        Category::create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'category_image' => $imagePath,
            'status' => 1, // default active
        ]);

        return redirect()->route('category.index')->with('success', 'Category created successfully.');
    }

    public function edit(string $id)
    {
        $data = [
            'title' => 'Edit Category | Deedy Admin Panel',
        ];

        $category = Category::findOrFail($id);
        $parentCategories = Category::where('id', '!=', $id)->get();

        return view('admin.pages.categories.edit_category', compact('category', 'parentCategories', 'data'));
    }

    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'parent_id' => 'nullable|exists:categories,id',
                'category_image' => 'image|max:2048',
            ]);

            if ($request->parent_id == $id) {
                return redirect()->route('category.index')->with('failed', 'A category cannot be its own parent.');
            }

            $category = Category::findOrFail($id);
            $imagePath = $category->category_image;

            if ($request->hasFile('category_image')) {
                if ($imagePath && file_exists(public_path($imagePath))) {
                    unlink(public_path($imagePath));
                }
                $file = $request->file('category_image');
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('upload/category_images'), $filename);
                $imagePath = 'upload/category_images/' . $filename;
            }

            $category->update([
                'name' => $request->name,
                'parent_id' => $request->parent_id,
                'category_image' => $imagePath,
                'status' => $request->status ?? $category->status, // keep old status if not sent
            ]);

            return redirect()->route('category.index')->with('success', 'Category updated successfully.');
        } catch (\Exception $e) {
            Log::error('Category update failed: ' . $e->getMessage());
            return redirect()->route('category.index')->with('failed', 'Something went wrong while updating the category.');
        }
    }

    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('category.index')->with('success', 'Category deleted successfully.');
    }
}
