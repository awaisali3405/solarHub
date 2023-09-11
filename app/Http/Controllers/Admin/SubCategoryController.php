<?php

namespace App\Http\Controllers\Admin;

use App\Http\Repositories\SubCategoryRepository;
use App\Http\Requests\SubCategoryRequest;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{

    private SubCategoryRepository $subCategoryRepository;
    public function __construct(SubCategoryRepository $subCategoryRepository)
    {
        parent::__construct();
        $this->subCategoryRepository = $subCategoryRepository;
        $this->pageTitle = 'Sub Category';
        $this->breadcrumbs[route('admin.dashboard')] = ['icon' => 'fa fa-fw fa-home', 'title' => 'Dashboard'];
        $this->breadcrumbs[route('admin.subCategory.index')] = ['icon' => 'fa fa-fw fa-home', 'title' => 'subCategory'];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        try {
            return view('admin.subCategory.index', [
                'subCategory' => $this->subCategoryRepository->all(),
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
        $this->pageHeading = (($id == 0) ? 'Add subCategory' : 'Edit subCategory');
        $this->breadcrumbs['javascript:{};'] = ['icon' => 'fa fa-fw fa-money', 'title' => $this->pageHeading];
        try {
            return view('admin.subCategory.form', [
                'subCategorys' => $this->subCategoryRepository->get($id),
                'category' => Category::all(),
                'action' => route('admin.subCategory.update', $id),
            ]);
        } catch (Exception $exception) {
            return redirect()->route('admin.dashboard')->with('error', $exception->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param subCategoryRequest $request
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $subCategoryRequest, $id)
    {

        $data = $subCategoryRequest->only('name', 'category_id');
        // dd($data);
        try {
            $this->subCategoryRepository->save($data, $id);
            $message = $id > 0 ? 'subCategory Updated Successfully' : 'subCategory Added Successfully';
            return redirect(route('admin.subCategory.index'))->with('success', $message);
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
            $this->subCategoryRepository->destroy($id);
            $data = $this->all();
            return response()->json(['msg' => 'subCategory deleted successfully.', 'data' => $data]);
        } catch (Exception $exception) {
            return response()->json(['msg' => 'subCategory Not Found.']);
        }
    }

    private function all(): string
    {
        $subCategory = $this->subCategoryRepository->all();
        $data = '<table id="dataTable" class="table table-striped" style="width:100%"><thead><tr><th>Sr#</th><th>Name</th><th>Guard Name</th><th>Created At</th><th>Updated At</th><th>Action</th></tr></thead><tbody>';
        if (count($subCategory) > 0) {
            foreach ($subCategory as $key => $val) {
                $data .= '<tr><td class="width-10">' . ($key + 1) . '</td>';
                $data .= '<td class="width-20">' . $val->name . '</td>';
                $data .= '<td class="width-20">' . $val->guard_name . '</td>';
                $data .= '<td class="width-15">' . $val->created_at . '</td>';
                $data .= '<td class="width-15">' . $val->updated_at . '</td>';
                $data .= '<td class="width-20"><a href="' . route('admin.subCategory.edit', $val->id) . '" title="Edit"><i class="fa fa-edit"></i></a> <a href="javascript:{};" data-url="' . route('admin.subCategory.destroy', $val->id) . '" title="Delete" class="delete"><i class="fa fa-trash"></i></a></td></tr>';
            }
        } else {
            $data .= '<tr><td colspan="6">No Record Found.</td></tr>';
        }
        $data .= '</tbody><tfoot><tr><th>Sr#</th><th>Name</th><th>Guard Name</th><th>Created At</th><th>Updated At</th><th>Action</th></tr></tfoot></table>';
        return $data;
    }
}
