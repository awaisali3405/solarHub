<?php

namespace App\Http\Controllers\Admin;

use App\Http\Repositories\SupplierRepository;

use Exception;
use Illuminate\Http\Request;

class SupplierController extends Controller
{

    private SupplierRepository $supplierRepository;
    public function __construct(SupplierRepository $supplierRepository)
    {
        parent::__construct();
        $this->supplierRepository = $supplierRepository;
        $this->pageTitle = 'supplier';
        $this->breadcrumbs[route('admin.dashboard')] = ['icon' => 'fa fa-fw fa-home', 'title' => 'Dashboard'];
        $this->breadcrumbs[route('admin.supplier.index')] = ['icon' => 'fa fa-fw fa-home', 'title' => 'supplier'];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        try {
            return view('admin.supplier.index', [
                'supplier' => $this->supplierRepository->all(),
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
        $supplier = $this->supplierRepository->get($id);

        if ($supplier->status == 1) {

            $data['status'] = 0;
            $message = 'supplier De-activated Successfully';
        } else {

            $data['status'] = 1;
            $message = 'supplier Activated Successfully';
        }
        $this->supplierRepository->save($data, $id);
        return redirect(route('admin.supplier.index'))->with('success', $message);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit($id)
    {
        $this->pageHeading = (($id == 0) ? 'Add supplier' : 'Edit supplier');
        $this->breadcrumbs['javascript:{};'] = ['icon' => 'fa fa-fw fa-money', 'title' => $this->pageHeading];
        try {
            return view('admin.supplier.form', [
                'supplier' => $this->supplierRepository->get($id),

                'action' => route('admin.supplier.update', $id),
            ]);
        } catch (Exception $exception) {
            return redirect()->route('admin.dashboard')->with('error', $exception->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param supplierRequest $request
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $supplierRequest, $id)
    {
        $data = $supplierRequest->only('name', 'business_name', 'cnic', 'phone', 'address');
        try {
            $this->supplierRepository->save($data, $id);
            $message = $id > 0 ? 'supplier Updated Successfully' : 'supplier Added Successfully';
            return redirect(route('admin.supplier.index'))->with('success', $message);
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
            $this->supplierRepository->destroy($id);
            $data = $this->all();
            return response()->json(['msg' => 'supplier deleted successfully.', 'data' => $data]);
        } catch (Exception $exception) {
            return response()->json(['msg' => 'supplier Not Found.']);
        }
    }

    private function all(): string
    {
        $supplier = $this->supplierRepository->all();
        $data = '<table id="dataTable" class="table table-striped" style="width:100%"><thead><tr><th>Sr#</th><th>Name</th><th>Guard Name</th><th>Created At</th><th>Updated At</th><th>Action</th></tr></thead><tbody>';
        if (count($supplier) > 0) {
            foreach ($supplier as $key => $val) {
                $data .= '<tr><td class="width-10">' . ($key + 1) . '</td>';
                $data .= '<td class="width-20">' . $val->name . '</td>';
                $data .= '<td class="width-20">' . $val->guard_name . '</td>';
                $data .= '<td class="width-15">' . $val->created_at . '</td>';
                $data .= '<td class="width-15">' . $val->updated_at . '</td>';
                $data .= '<td class="width-20"><a href="' . route('admin.supplier.edit', $val->id) . '" title="Edit"><i class="fa fa-edit"></i></a> <a href="javascript:{};" data-url="' . route('admin.supplier.destroy', $val->id) . '" title="Delete" class="delete"><i class="fa fa-trash"></i></a></td></tr>';
            }
        } else {
            $data .= '<tr><td colspan="6">No Record Found.</td></tr>';
        }
        $data .= '</tbody><tfoot><tr><th>Sr#</th><th>Name</th><th>Guard Name</th><th>Created At</th><th>Updated At</th><th>Action</th></tr></tfoot></table>';
        return $data;
    }
}