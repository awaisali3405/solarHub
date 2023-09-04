<?php

namespace App\Http\Controllers\Admin;

use App\Http\Repositories\AccessoriesRepository;
use App\Http\Requests\AccessoriesRequest;
use Exception;
use Illuminate\Http\Request;

class AccessoriesController extends Controller
{

    private AccessoriesRepository $accessoriesRepository;
    public function __construct(AccessoriesRepository $accessoriesRepository)
    {
        parent::__construct();
        $this->accessoriesRepository = $accessoriesRepository;
        $this->pageTitle = 'accessories';
        $this->breadcrumbs[route('admin.dashboard')] = ['icon' => 'fa fa-fw fa-home', 'title' => 'Dashboard'];
        $this->breadcrumbs[route('admin.accessories.index')] = ['icon' => 'fa fa-fw fa-home', 'title' => 'accessories'];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        try {
            return view('admin.accessories.index', [
                'accessories' => $this->accessoriesRepository->all(),
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
        $product = $this->accessoriesRepository->get($id);

        if ($product->status == 1) {

            $data['status'] = 0;
            $message = 'accessories De-activated Successfully';
        } else {

            $data['status'] = 1;
            $message = 'accessories Activated Successfully';
        }
        $this->accessoriesRepository->save($data, $id);
        return redirect(route('admin.accessories.index'))->with('success', $message);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit($id)
    {
        $this->pageHeading = (($id == 0) ? 'Add accessories' : 'Edit accessories');
        $this->breadcrumbs['javascript:{};'] = ['icon' => 'fa fa-fw fa-money', 'title' => $this->pageHeading];
        try {
            return view('admin.accessories.form', [
                'accessories' => $this->accessoriesRepository->get($id),

                'action' => route('admin.accessories.update', $id),
            ]);
        } catch (Exception $exception) {
            return redirect()->route('admin.dashboard.index')->with('error', $exception->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AccessoriesRequest $request
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(AccessoriesRequest $accessoriesRequest, $id)
    {
        $data = $accessoriesRequest->except('_token');
        // $data['status'] = 1;
        try {
            $this->accessoriesRepository->save($data, $id);
            $message = $id > 0 ? 'accessories Updated Successfully' : 'accessories Added Successfully';
            return redirect(route('admin.accessories.index'))->with('success', $message);
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
            $this->accessoriesRepository->destroy($id);
            $data = $this->all();
            return response()->json(['msg' => 'accessories deleted successfully.', 'data' => $data]);
        } catch (Exception $exception) {
            return response()->json(['msg' => 'accessories Not Found.']);
        }
    }

    private function all(): string
    {
        $accessories = $this->accessoriesRepository->all();
        $data = '<table id="dataTable" class="table table-striped" style="width:100%"><thead><tr><th>Sr#</th><th>Name</th><th>Guard Name</th><th>Created At</th><th>Updated At</th><th>Action</th></tr></thead><tbody>';
        if (count($accessories) > 0) {
            foreach ($accessories as $key => $val) {
                $data .= '<tr><td class="width-10">' . ($key + 1) . '</td>';
                $data .= '<td class="width-20">' . $val->name . '</td>';
                $data .= '<td class="width-20">' . $val->guard_name . '</td>';
                $data .= '<td class="width-15">' . $val->created_at . '</td>';
                $data .= '<td class="width-15">' . $val->updated_at . '</td>';
                $data .= '<td class="width-20"><a href="' . route('admin.accessories.edit', $val->id) . '" title="Edit"><i class="fa fa-edit"></i></a> <a href="javascript:{};" data-url="' . route('admin.accessories.destroy', $val->id) . '" title="Delete" class="delete"><i class="fa fa-trash"></i></a></td></tr>';
            }
        } else {
            $data .= '<tr><td colspan="6">No Record Found.</td></tr>';
        }
        $data .= '</tbody><tfoot><tr><th>Sr#</th><th>Name</th><th>Guard Name</th><th>Created At</th><th>Updated At</th><th>Action</th></tr></tfoot></table>';
        return $data;
    }
}
