<?php

namespace App\Http\Controllers\Admin;

use App\Http\Repositories\CategoryRepository;
use App\Http\Requests\categoryRequest;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    private CategoryRepository $categoryRepository;
    public function __construct(CategoryRepository $categoryRepository)
    {
        parent::__construct();
        $this->categoryRepository = $categoryRepository;
        $this->pageTitle = 'Category';
        $this->breadcrumbs[route('admin.dashboard')] = ['icon' => 'fa fa-fw fa-home', 'title' => 'Dashboard'];
        $this->breadcrumbs[route('admin.category.index')] = ['icon' => 'fa fa-fw fa-home', 'title' => 'category'];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        try {
            return view('admin.category.index', [
                'category' => $this->categoryRepository->all(),
            ]);
        } catch (Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit($id)
    {
        $this->pageHeading = (($id == 0) ? 'Add category' : 'Edit category');
        $this->breadcrumbs['javascript:{};'] = ['icon' => 'fa fa-fw fa-money', 'title' => $this->pageHeading];
        try {
            return view('admin.category.form', [
                'categorys' => $this->categoryRepository->get($id),

                'action' => route('admin.category.update', $id),
            ]);
        } catch (Exception $exception) {
            return redirect()->route('admin.dashboard.index')->with('error', $exception->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param categoryRequest $request
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(CategoryRequest $categoryRequest, $id)
    {
        $data = $categoryRequest->only('name');
        // $data['status'] = 1;
        try {
            $this->categoryRepository->save($data, $id);
            $message = $id > 0 ? 'category Updated Successfully' : 'category Added Successfully';
            return redirect(route('admin.category.index'))->with('success', $message);
        } catch (Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            $this->categoryRepository->destroy($id);
            $data = $this->all();
            return response()->json(['msg' => 'category deleted successfully.', 'data' => $data]);
        } catch (Exception $exception) {
            return response()->json(['msg' => 'category Not Found.']);
        }
    }

    private function all(): string
    {
        $category = $this->categoryRepository->all();
        $data = '<table id="dataTable" class="table table-striped" style="width:100%"><thead><tr><th>Sr#</th><th>Name</th><th>Guard Name</th><th>Created At</th><th>Updated At</th><th>Action</th></tr></thead><tbody>';
        if (count($category) > 0) {
            foreach ($category as $key => $val) {
                $data .= '<tr><td class="width-10">' . ($key + 1) . '</td>';
                $data .= '<td class="width-20">' . $val->name . '</td>';
                $data .= '<td class="width-20">' . $val->guard_name . '</td>';
                $data .= '<td class="width-15">' . $val->created_at . '</td>';
                $data .= '<td class="width-15">' . $val->updated_at . '</td>';
                $data .= '<td class="width-20"><a href="' . route('admin.category.edit', $val->id) . '" title="Edit"><i class="fa fa-edit"></i></a> <a href="javascript:{};" data-url="' . route('admin.category.destroy', $val->id) . '" title="Delete" class="delete"><i class="fa fa-trash"></i></a></td></tr>';
            }
        } else {
            $data .= '<tr><td colspan="6">No Record Found.</td></tr>';
        }
        $data .= '</tbody><tfoot><tr><th>Sr#</th><th>Name</th><th>Guard Name</th><th>Created At</th><th>Updated At</th><th>Action</th></tr></tfoot></table>';
        return $data;
    }
}
