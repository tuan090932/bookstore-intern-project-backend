<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommonController extends Controller
{
    /**
     * Display the confirmation modal view.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\View\View
     */
    public function showConfirmModal(Request $request)
    {
        $ids = $request->input('ids');
        $url = $request->input('url');
        $title = $request->input('title');
        $body = $request->input('body');
        $method = $request->input('method');
        $confirmText = $request->input('confirmText');

        return view('components.confirm-modal', compact('title', 'body', 'confirmText', 'url', 'ids', 'method'));
    }
}
