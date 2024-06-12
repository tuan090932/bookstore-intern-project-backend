<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Author::query();

        // Filter by age range
        if ($request->has('min_age') && $request->min_age !== null)
        {
            $query->where('age', '>=', $request->min_age);
        }
        if ($request->has('max_age') && $request->max_age !== null)
        {
            $query->where('age', '<=', $request->max_age);
        }

        // Filter by death status
        if ($request->has('death_status') && $request->death_status !== null)
        {
            if ($request->death_status == 'alive')
            {
                $query->whereNull('death_date');
            }
            elseif ($request->death_status == 'deceased')
            {
                $query->whereNotNull('death_date');
            }
        }

        // Sorting
        if ($request->has('sort_by') && $request->sort_by !== null)
        {
            switch ($request->sort_by)
            {
                case 'name_asc':
                    $query->orderBy('author_name', 'asc');
                    break;
                case 'age_asc':
                    $query->orderBy('age', 'asc');
                    break;
                case 'age_desc':
                    $query->orderBy('age', 'desc');
                    break;
                case 'birth_date_asc':
                    $query->orderBy('birth_date', 'asc');
                    break;
                case 'birth_date_desc':
                    $query->orderBy('birth_date', 'desc');
                    break;
                case 'death_date_asc':
                    $query->orderBy('death_date', 'asc');
                    break;
                case 'death_date_desc':
                    $query->orderBy('death_date', 'desc');
                    break;
                default:
                    break;
            }
        }

        $authors = $query->paginate(15);

        return view('admin.pages.authors.index', compact('authors'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
