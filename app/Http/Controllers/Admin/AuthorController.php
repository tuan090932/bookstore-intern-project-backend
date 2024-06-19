<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Author;
use Carbon\Carbon;
use App\Rules\ValidBirthDate;
use App\Rules\ValidDeathDate;
use App\Http\Requests\StoreAuthorRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Support\Facades\Log;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View The view displaying the list of authors.
     */
    public function index()
    {
        $authors = Author::paginate(15);

        return view('admin.pages.authors.index', compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.authors.create');
    }

    /**
     * Store a newly created author resource in the database.
     *
     * @param // \Illuminate\Http\Request  $request
     * @return // \Illuminate\Http\Response
     */
    public function store(StoreAuthorRequest $request)
    {
        try {
            $authorName = $request->input('author_name');
            $birthDate = Carbon::createFromFormat('d/m/Y', $request->input('birth_date'));
            $deathDate = $request->input('death_date') ? Carbon::createFromFormat('d/m/Y', $request->input('death_date')) : null;
            $national = $request->input('national');

            $age = $deathDate ? $deathDate->year - $birthDate->year : Carbon::now()->year - $birthDate->year;

            Author::create([
                'author_name' => $authorName,
                'birth_date' => $birthDate,
                'death_date' => $deathDate ? $deathDate : null,
                'age' => $age,
                'national' => $national,
            ]);

            return redirect()->back()->with('success', __('messages.author_created_success'));
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return redirect()->back()->with('success', __('messages.author_creation_failed'));
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
     * Remove the specified author resource from the database.
     *
     * @param int $id The ID of the author to be deleted.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            $author = Author::findOrFail($id);
            $author->delete();

            return redirect()->back()->with('success', __('messages.author_deleted_success'));
        } catch (Exception $e) {
            Log::error('Error deleting author: ' . $e->getMessage());

            return redirect()->back()->with('error', __('messages.author_deletion_failed'));
        }
    }

    /**
     * Display a listing of the trashed author resources.
     *
     * @return \Illuminate\View\View
     */
    public function trashed()
    {
        $authors = Author::onlyTrashed()->paginate(15);

        return view('admin.pages.authors.restore', compact('authors'));
    }

    /**
     * Restore the specified author from the trash.
     *
     * @param int $id The ID of the author to be restored.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($id)
    {
        try {
            $author = Author::onlyTrashed()->findOrFail($id);
            $author->restore();

            return redirect()->back()->with('success', __('messages.author_restored_success'));
        } catch (Exception $e) {
            Log::error('Error restoring author: ' . $e->getMessage());

            return redirect()->back()->with('error', __('messages.author_restoration_failed'));
        }
    }

    /**
     * Bulk restore selected author resources from the trash.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restoreSelected(Request $request)
    {
        try {
            $authorIds = $request->input('author_ids');
            if ($authorIds) {
                Author::onlyTrashed()->whereIn('id', $authorIds)->restore();
                return redirect()->back()->with('success', __('messages.selected_authors_restored_success'));
            }
            return redirect()->back()->with('error', __('messages.no_authors_selected'));
        } catch (Exception $e) {
            Log::error('Error bulk restoring authors: ' . $e->getMessage());
            return redirect()->back()->with('error', __('messages.selected_authors_restoration_failed'));
        }
    }

    /**
     * Bulk delete selected author resources from the database.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteSelected(Request $request)
    {
        try {
            $authorIds = $request->input('author_ids');
            if ($authorIds) {
                Author::whereIn('id', $authorIds)->delete();
                return redirect()->back()->with('success', __('messages.selected_authors_deleted_success'));
            }
            return redirect()->back()->with('error', __('messages.no_authors_selected'));
        } catch (Exception $e) {
            Log::error('Error bulk deleting authors: ' . $e->getMessage());
            return redirect()->back()->with('error', __('messages.selected_authors_deletion_failed'));
        }
    }

    /**
     * Delete all author resources from the database.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteAll()
    {
        try {
            Author::query()->delete();
            return redirect()->back()->with('success', __('messages.all_authors_deleted_success'));
        } catch (Exception $e) {
            Log::error('Error deleting all authors: ' . $e->getMessage());
            return redirect()->back()->with('error', __('messages.all_authors_deletion_failed'));
        }
    }

    /**
     * Restore all trashed author resources from the trash.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restoreAll()
    {
        try {
            Author::onlyTrashed()->restore();
            return redirect()->back()->with('success', __('messages.all_authors_restored_success'));
        } catch (Exception $e) {
            Log::error('Error restoring all authors: ' . $e->getMessage());
            return redirect()->back()->with('error', __('messages.all_authors_restoration_failed'));
        }
    }

}
