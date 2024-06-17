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

            return redirect()->back()->with('success', 'Tạo tác giả thành công.');
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi tạo tác giả. Vui lòng thử lại.');
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
     * This method is responsible for deleting a specific author record from the database based on the provided author ID.
     * It first attempts to find the author by ID and, if found, deletes the record.
     * If the deletion is successful, it redirects the user back with a success message.
     * In case of any exceptions or if the author is not found, it logs the error and redirects back with an error message.
     *
     * @param int $id The ID of the author to be deleted.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try
        {
            $author = Author::findOrFail($id);
            $author->delete();

            return redirect()->back()->with('success', 'Tác giả đã được xóa thành công.');
        }
        catch (Exception $e)
        {
            Log::error('Error deleting author: '.$e->getMessage());

            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi xóa tác giả. Vui lòng thử lại.');
        }
    }

    /**
     * Display a listing of the trashed author resources.
     *
     * This method retrieves all author records that have been soft deleted (moved to the trash).
     * It paginates the results to show 15 authors per page and returns a view with the list of trashed authors.
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
     * This method is responsible for restoring a soft deleted author record back to active status based on the provided author ID.
     * It first attempts to find the trashed author by ID and, if found, restores the record.
     * If the restoration is successful, it redirects the user back with a success message.
     * In case of any exceptions or if the author is not found, it logs the error and redirects back with an error message.
     *
     * @param int $id The ID of the author to be restored.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($id)
    {
        try
        {
            $author = Author::onlyTrashed()->findOrFail($id);
            $author->restore();

            return redirect()->back()->with('success', 'Tác giả đã được khôi phục thành công.');
        }
        catch (Exception $e)
        {
            Log::error('Error restoring author: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi khôi phục tác giả. Vui lòng thử lại.');
        }
    }

    /**
     * Bulk restore selected author resources from the trash.
     *
     * This method is responsible for restoring multiple soft-deleted author records back to active status based on the list of author IDs provided in the $request object.
     * It first retrieves the list of author IDs from the request and checks if any IDs are provided.
     * If IDs are provided, it performs a bulk restore operation on the authors matching those IDs.
     * If the operation is successful, it redirects the user back with a success message.
     * If no IDs are provided, it redirects back with an error message indicating that no authors were selected.
     * In case of any exceptions during the operation, it logs the error and redirects back with an error message.
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restoreSelected(Request $request)
    {
        try
        {
            $authorIds = $request->input('author_ids');
            if ($authorIds)
            {
                Author::onlyTrashed()->whereIn('author_id', $authorIds)->restore();
                return redirect()->back()->with('success', 'Những tác giả được chọn đã khôi phục thành công.');
            }
            return redirect()->back()->with('error', 'Không tác giả nào được chọn.');
        }
        catch (Exception $e)
        {
            Log::error('Error bulk restoring authors: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi khôi phục những tác giả được chọn. Vui lòng thử lại.');
        }
    }

    /**
     * Restore all trashed author resources.
     *
     * This method is responsible for restoring all soft-deleted author records back to active status.
     * It performs a restore operation on all trashed authors.
     * If the operation is successful, it redirects the user back with a success message.
     * In case of any exceptions during the operation, it logs the error and redirects back with an error message.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restoreAll()
    {
        try
        {
            Author::onlyTrashed()->restore();
            return redirect()->back()->with('success', 'Tất cả tác giả đã được khôi phục thành công.');
        }
        catch (Exception $e)
        {
            Log::error('Error restoring all authors: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi khôi phục tất cả tác giả. Vui lòng thử lại.');
        }
    }

    /**
     * Bulk delete selected author resources from the database.
     *
     * This method is responsible for deleting multiple author records from the database based on the list of author IDs provided in the $request object.
     * It first retrieves the list of author IDs from the request and checks if any IDs are provided.
     * If IDs are provided, it performs a bulk delete operation on the authors matching those IDs.
     * If the operation is successful, it redirects the user back with a success message.
     * If no IDs are provided, it redirects back with an error message indicating that no authors were selected.
     * In case of any exceptions during the operation, it logs the error and redirects back with an error message.
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteSelected(Request $request)
    {
        try
        {
            $authorIds = $request->input('author_ids');
            if ($authorIds)
            {
                Author::whereIn('author_id', $authorIds)->delete();
                return redirect()->back()->with('success', 'Những tác giả được chọn đã xóa thành công.');
            }
            return redirect()->back()->with('error', 'Không tác giả nào được chọn.');
        }
        catch (Exception $e)
        {
            Log::error('Error bulk deleting authors: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi xóa những tác giả được chọn. Vui lòng thử lại.');
        }
    }

    /**
     * Delete all author resources from the database.
     *
     * This method is responsible for deleting all author records from the database.
     * It performs a delete operation on the entire Author table, removing all author records.
     * If the operation is successful, it redirects the user back with a success message.
     * In case of any exceptions during the operation, it logs the error and redirects back with an error message.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteAll()
    {
        try
        {
            Author::query()->delete();
            return redirect()->back()->with('success', 'Tất cả tác giả đã được xóa thành công.');
        }
        catch (Exception $e)
        {
            Log::error('Error deleting all authors: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi xóa tất cả tác giả. Vui lòng thử lại.');
        }
    }

}
