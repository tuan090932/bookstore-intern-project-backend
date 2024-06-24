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
            Category::create([
                'category_name' => $request->input('category_name')
            ]);
            return redirect()->route('categories.create')->with('success', __('messages.category.created_success'));     
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('categories.create')->with('error', __('messages.category.created_error'));
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
            return redirect()->route('categories.index')->with('error', __('messages.category.not_found'));
        }  catch (Exception $e) {
            return redirect()->route('categories.index')->with('error', __('messages.category.fetch_error'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateCategoryRequest $request, $id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->category_name = $request->input('category_name');
            $category->save();
            return redirect()->route('categories.edit', $id)->with('success', __('messages.category.updated_success'));
        } catch (ModelNotFoundException $e) {
            return redirect()->route('categories.index', $id)->with('error', __('messages.category.not_found'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('categories.edit', $id)->with('error', __('messages.category.updated_error'));
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
                return redirect()->route('categories.index')->withErrors(['category_' . $id => __('messages.category.associated_books')]);
            }
            $category->delete();
            return redirect()->route('categories.index')->with('success', __('messages.category.deleted_success'));
        } catch (ModelNotFoundException $e) {
            return redirect()->route('categories.index')->with('error', __('messages.category.not_found'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('categories.index')->with('error', __('messages.category.deleted_error'));
        }
    }
}
