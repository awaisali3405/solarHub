<?php

namespace App\Http\Controllers\Admin;

use App\Http\Repositories\CategoryRepository;
use App\Http\Requests\categoryRequest;
use Exception;
use Illuminate\Http\Request;

class ChatController extends Controller
{

//    private CategoryRepository $categoryRepository;
    public function __construct()
    {
        parent::__construct();
//        $this->categoryRepository = $categoryRepository;
        $this->pageTitle = 'Chat';

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        try {
            return view('admin.chat.index');
        } catch (Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }


}
