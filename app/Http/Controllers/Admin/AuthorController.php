<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Author;
use Carbon\Carbon;
use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\AuthorRequest;
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
     * Show the form for editing the specified author resource.
     *
     * This method is responsible for retrieving the author data based on the provided author ID
     * and displaying the edit form with the current author information pre-filled.
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
     * This method is responsible for updating an existing author record in the database based on the input data provided in the $request object.
     * It first validates the input data, ensuring that the required fields (author_name, birth_date) are provided and that the death_date field is a valid date if present.
     * It then calculates the author's age based on the birth_date and either the death_date or the current date if the death_date is not provided.
     * Finally, it updates the Author record in the database and redirects the user back to the edit page with a success or error message depending on the outcome of the operation.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id The ID of the author to be updated.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AuthorRequest $request, $id)
    {
        try
        {
            $authorName = $request->input('author_name');
            $birthDate = Carbon::createFromFormat('d/m/Y', $request->input('birth_date'));
            $deathDate = $request->input('death_date') ? Carbon::createFromFormat('d/m/Y', $request->input('death_date')) : null;

            $age = $deathDate ? $deathDate->year - $birthDate->year : Carbon::now()->year - $birthDate->year;

            $author = Author::findOrFail($id);
            $author->update([
                'author_name' => $authorName,
                'birth_date' => $birthDate,
                'death_date' => $deathDate ? $deathDate : null,
                'age' => $age,
            ]);

            return redirect()->back()->with('success', 'Cập nhật tác giả thành công.');
        }
        catch (Exception $e)
        {
            // Logging the exception can be useful for debugging purposes
            Log::error('Error updating author: '.$e->getMessage());

            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi cập nhật tác giả. Vui lòng thử lại.');
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
