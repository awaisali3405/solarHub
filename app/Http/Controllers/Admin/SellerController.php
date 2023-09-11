<?php

namespace App\Http\Controllers\Admin;

use App\Http\Repositories\AdminRepository;
use App\Models\Admin;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SellerController extends Controller
{

    private AdminRepository $AdminRepository;
    public function __construct(AdminRepository $AdminRepository)
    {
        parent::__construct();
        $this->AdminRepository = $AdminRepository;
        $this->pageTitle = 'seller';
        $this->breadcrumbs[route('admin.dashboard')] = ['icon' => 'fa fa-fw fa-home', 'title' => 'Dashboard'];
        $this->breadcrumbs[route('admin.seller.index')] = ['icon' => 'fa fa-fw fa-home', 'title' => 'seller'];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        try {
            return view('admin.seller.index', [
                'seller' => $this->AdminRepository->all(),
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
        $seller = $this->AdminRepository->get($id);

        if ($seller->status == 1) {

            $data['status'] = 0;
            $message = 'seller De-activated Successfully';
        } else {

            $data['status'] = 1;
            $message = 'seller Activated Successfully';
        }
        $this->AdminRepository->save($data, $id);
        return redirect(route('admin.seller.index'))->with('success', $message);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit($id)
    {
        $this->pageHeading = (($id == 0) ? 'Add seller' : 'Edit seller');
        $this->breadcrumbs['javascript:{};'] = ['icon' => 'fa fa-fw fa-money', 'title' => $this->pageHeading];
        try {
            return view('admin.seller.form', [
                'seller' => $this->AdminRepository->get($id),

                'action' => route('admin.seller.update', $id),
            ]);
        } catch (Exception $exception) {
            return redirect()->route('admin.dashboard')->with('error', $exception->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param sellerRequest $request
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $sellerRequest, $id)
    {
        $data = $sellerRequest->except('_token');
        if(isset($data['password'])){
            $data['password']=Hash::make($data['password']);
        }

        try {
            $this->AdminRepository->save($data, $id);
            $message = $id > 0 ? 'seller Updated Successfully' : 'seller Added Successfully';
            return redirect(route('admin.seller.index'))->with('success', $message);
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
            $this->AdminRepository->destroy($id);
            $data = $this->all();
            return response()->json(['msg' => 'seller deleted successfully.', 'data' => $data]);
        } catch (Exception $exception) {
            return response()->json(['msg' => 'seller Not Found.']);
        }
    }

    private function all(): string
    {
        $seller = $this->AdminRepository->all();
        $data = '<table id="dataTable" class="table table-striped" style="width:100%"><thead><tr><th>Sr#</th><th>Name</th><th>Guard Name</th><th>Created At</th><th>Updated At</th><th>Action</th></tr></thead><tbody>';
        if (count($seller) > 0) {
            foreach ($seller as $key => $val) {
                $data .= '<tr><td class="width-10">' . ($key + 1) . '</td>';
                $data .= '<td class="width-20">' . $val->name . '</td>';
                $data .= '<td class="width-20">' . $val->guard_name . '</td>';
                $data .= '<td class="width-15">' . $val->created_at . '</td>';
                $data .= '<td class="width-15">' . $val->updated_at . '</td>';
                $data .= '<td class="width-20"><a href="' . route('admin.seller.edit', $val->id) . '" title="Edit"><i class="fa fa-edit"></i></a> <a href="javascript:{};" data-url="' . route('admin.seller.destroy', $val->id) . '" title="Delete" class="delete"><i class="fa fa-trash"></i></a></td></tr>';
            }
        } else {
            $data .= '<tr><td colspan="6">No Record Found.</td></tr>';
        }
        $data .= '</tbody><tfoot><tr><th>Sr#</th><th>Name</th><th>Guard Name</th><th>Created At</th><th>Updated At</th><th>Action</th></tr></tfoot></table>';
        return $data;
    }
}
