<?php

namespace App\Http\Controllers\Admin;


use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Book;
use Illuminate\Support\Facades\Log;
use Exception;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $categories = Category::paginate(10);
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
    public function store(StoreCategoryRequest $request)
    {
        try {
            $category = Category::create([
                'category_name' => $request->input('category_name')
            ]);
            if ($category) {
                return redirect()->route('categories.create')->with('success', 'Category created successfully');
            }
        } catch (Exception $e) {
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
        try {
            $category = Category::findOrFail($id);
            return view('admin.pages.categories.edit', compact('category'));
        } catch (ModelNotFoundException $e) {
            return redirect()->route('categories.index')->with('error', 'Category not found');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateCategoryRequest  $request, $id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->category_name = $request->input('category_name');
            $category->save();
            return redirect()->route('categories.edit', $id)->with('success', 'Category updated successfully');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('categories.index', $id)->with('error', 'Category not found');
        } catch (Exception $e) {
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
        try {
            $category = Category::findOrFail($id);
            $bookCount = Book::where('category_id', $id)->count();
            if ($bookCount > 0) {
                $errorMessage = 'Cannot delete category because it is associated with one or more books';
                return redirect()->route('categories.index')->withErrors(['category_' . $id => $errorMessage]);
            }
            $category->delete();
            return redirect()->route('categories.index')->with('success', 'Category deleted successfully');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('categories.index')->with('error', 'Category not found');
        } catch (Exception $e) {
            return redirect()->route('categories.index')->with('error', 'Category deletion failed');
        }
    }
}
