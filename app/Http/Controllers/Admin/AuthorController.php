<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Author;
use Carbon\Carbon;
use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\AuthorRequest;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\AuthorRequest;

class AuthorController extends Controller
{
    /**
     * This property stores the route for the search functionality.
     * It is initialized in the constructor to ensure it is properly set for use in the views.
     *
     * @var string
     */
    protected $searchRoute;

    /**
     * Controller constructor.
     *
     * Initializes the search route to direct search requests to the appropriate controller action.
     */
    public function __construct()
    {
        $this->searchRoute = route('authors.search');
    }

    /**
     * Display a listing of the authors.
     *
     * This method retrieves a paginated list of authors from the database.
     * It then returns the view to display the authors list, passing the authors data and the search route to the view.
     * The searchRoute variable is used in the view to direct the search form to the appropriate controller action.
     *
     * @return \Illuminate\View\View
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View The view displaying the list of authors.
     */
    public function index()
    {
        $authors = Author::paginate(15);

        return view('admin.pages.authors.index', ['authors' => $authors, 'searchRoute' => $this->searchRoute]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.authors.create', ['searchRoute' => $this->searchRoute]);
    }

    /**
     * Search for authors.
     *
     * @param // \Illuminate\Http\Request  $request
     * @return // \Illuminate\Http\Response
     */
    public function store(AuthorRequest $request)
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

            return redirect()->back()->with('success', __('messages.author.created_success'));
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return redirect()->back()->with('error', __('messages.author.created_error'));
        }
    }

    /**
     * Show the form for editing the specified author resource.
     *
     * @param int $id The ID of the author to be edited.
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $author = Author::findOrFail($id);
        return view('admin.pages.authors.edit', compact('author'));
    }

    /**
     * Update the specified author resource in the database.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id The ID of the author to be updated.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AuthorRequest $request, $id)
    {
        try {
            $authorName = $request->input('author_name');
            $birthDate = Carbon::createFromFormat('d/m/Y', $request->input('birth_date'));
            $deathDate = $request->input('death_date') ? Carbon::createFromFormat('d/m/Y', $request->input('death_date')) : null;
            $national = $request->input('national');

            $age = $deathDate ? $deathDate->year - $birthDate->year : Carbon::now()->year - $birthDate->year;

            $author = Author::findOrFail($id);
            $author->update([
                'author_name' => $authorName,
                'birth_date' => $birthDate,
                'death_date' => $deathDate ? $deathDate : null,
                'age' => $age,
                'national' => $national,
            ]);

            return redirect()->back()->with('success', __('messages.author.update_success'));
        } catch (Exception $e) {
            Log::error('Error updating author: '.$e->getMessage());

            return redirect()->back()->with('error', __('messages.author.update_error'));
        }
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

            return redirect()->back()->with('success', __('messages.author.deleted_success'));
        } catch (Exception $e) {
            Log::error('Error deleting author: ' . $e->getMessage());

            return redirect()->back()->with('error', __('messages.author.deleted_error'));
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

            return redirect()->back()->with('success', __('messages.author.restored_success'));
        } catch (Exception $e) {
            Log::error('Error restoring author: ' . $e->getMessage());

            return redirect()->back()->with('error', __('messages.author.restored_error'));
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
            $authorIds = $request->input('ids', []);

            Author::onlyTrashed()->whereIn('author_id', $authorIds)->restore();

            return redirect()->back()->with('success', __('messages.author.selected_restored_success'));
        } catch (Exception $e) {
            Log::error('Error restoring authors: ' . $e->getMessage());
            return redirect()->back()->with('error', __('messages.author.selected_restored_error'));
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
            $authorIds = $request->input('ids', []);

            Author::whereIn('author_id', $authorIds)->delete();

            return redirect()->back()->with('success', __('messages.author.selected_deleted_success'));
        } catch (Exception $e) {
            Log::error('Error deleting selected authors: ' . $e->getMessage());
            return redirect()->back()->with('error', __('messages.author.selected_deleted_error'));
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
            return redirect()->back()->with('success', __('messages.author.all_deleted_success'));
        } catch (Exception $e) {
            Log::error('Error deleting all authors: ' . $e->getMessage());
            return redirect()->back()->with('error', __('messages.author.all_deleted_error'));
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
            return redirect()->back()->with('success', __('messages.author.all_restored_success'));
        } catch (Exception $e) {
            Log::error('Error restoring all authors: ' . $e->getMessage());
            return redirect()->back()->with('error', __('messages.author.all_restored_error'));
        }
    }

    /**
     * Search for authors.
     *
     * @param \Illuminate\Http\Request $request The request object containing the search query.
     * @return \Illuminate\View\View
     */
    public function search(Request $request)
    {
        $query = $request->input('query');

        $authors = Author::where('author_name', 'LIKE', "%{$query}%")->paginate(15);

        return view('admin.pages.authors.index', ['authors' => $authors, 'query' => $query, 'searchRoute' => $this->searchRoute]);
    }
}
?>
