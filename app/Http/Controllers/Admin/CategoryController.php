<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Book;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {

        $categories = Category::paginate(15);
        return view('admin.pages.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.pages.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'category_name' => 'required|unique:categories,category_name',
        ]);

        try {
            $category = Category::create([
                'category_name' => $request->input('category_name')
            ]);

            if ($category) {
                return redirect()->route('categories.create')->with('success', 'Category created successfully');
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return redirect()->route('categories.create')->with('error', 'Category creation failed ');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string $id
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit(string $id)
    {
        $category = Category::find($id);

        if ($category === null) {
            return redirect()->route('categories.index')->with('error', 'Category not found');
        }

        return view('admin.pages.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        if ($category === null) {
            return redirect()->route('categories.index')->with('error', 'Category not found');
        }

        $request->validate([
            'category_name' => 'required|unique:categories,category_name,' . $category->category_id . ',category_id',
        ]);

        try {
            $category->category_name = $request->input('category_name');
            $category->save();

            return redirect()->route('categories.edit', $id)->with('success', 'Category updated successfully');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('categories.edit', $id)->with('error', 'Category update failed');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $id)
    {

        $category = Category::find($id);
        if ($category === null) {
            return redirect()->route('categories.index')->with('error', 'Category not found');
        }
        try {

            $bookCount = Book::where('category_id', $id)->count();
            if ($bookCount > 0) {
                return redirect()->route('categories.index')->with('error', 'Cannot delete category because it is associated with one or more books');
            }

            $category->delete();
            return redirect()->route('categories.index')->with('success', 'Category deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('categories.index')->with('error', 'Category deletion failed');
        }
    }
}
