<?php

namespace App\Http\Controllers\Admin;

use App\Http\Repositories\ContractRepository;

use App\Models\Contract;
use App\Models\PayTerm;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;

class ContractController extends Controller
{

    private ContractRepository $contractRepository;
    public function __construct(ContractRepository $contractRepository)
    {
        parent::__construct();
        $this->contractRepository = $contractRepository;
        $this->pageTitle = 'contract';
        $this->breadcrumbs[route('admin.dashboard')] = ['icon' => 'fa fa-fw fa-home', 'title' => 'Dashboard'];
        $this->breadcrumbs[route('admin.contract.index')] = ['icon' => 'fa fa-fw fa-home', 'title' => 'contract'];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        try {
            return view('admin.contract.index', [
                'contract' => $this->contractRepository->all(),
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
        try {
            return view('admin.contract.index', [
                'contract' => $this->contractRepository->show($id),
                'employee' => $id,
            ]);
        } catch (Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit($id)
    {
        $this->pageHeading = 'Add Contract';
        $this->breadcrumbs['javascript:{};'] = ['icon' => 'fa fa-fw fa-money', 'title' => $this->pageHeading];
        try {
            return view('admin.contract.form', [
                'employee' => $id,
                'product' => Product::where('category_id', 1)->get(),
                'action' => route('admin.contract.update', 0),
            ]);
        } catch (Exception $exception) {
            return redirect()->route('admin.dashboard')->with('error', $exception->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param contractRequest $request
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $contractRequest, $id)
    {
        // dd($contractRequest);
        $data = $contractRequest->except('_token', '_method');
        try {

            // dd($data);
            $this->contractRepository->save($data, $id);
            $message = $id > 0 ? 'contract Updated Successfully' : 'contract Added Successfully';
            return redirect(route('admin.contract.show', $data['employee_id']))->with('success', $message);
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
            $this->contractRepository->destroy($id);
            $data = $this->all();
            return response()->json(['msg' => 'contract deleted successfully.', 'data' => $data]);
        } catch (Exception $exception) {
            return response()->json(['msg' => 'contract Not Found.']);
        }
    }

    private function all(): string
    {
        $contract = $this->contractRepository->all();
        $data = '<table id="dataTable" class="table table-striped" style="width:100%"><thead><tr><th>Sr#</th><th>Name</th><th>Guard Name</th><th>Created At</th><th>Updated At</th><th>Action</th></tr></thead><tbody>';
        if (count($contract) > 0) {
            foreach ($contract as $key => $val) {
                $data .= '<tr><td class="width-10">' . ($key + 1) . '</td>';
                $data .= '<td class="width-20">' . $val->name . '</td>';
                $data .= '<td class="width-20">' . $val->guard_name . '</td>';
                $data .= '<td class="width-15">' . $val->created_at . '</td>';
                $data .= '<td class="width-15">' . $val->updated_at . '</td>';
                $data .= '<td class="width-20"><a href="' . route('admin.contract.edit', $val->id) . '" title="Edit"><i class="fa fa-edit"></i></a> <a href="javascript:{};" data-url="' . route('admin.contract.destroy', $val->id) . '" title="Delete" class="delete"><i class="fa fa-trash"></i></a></td></tr>';
            }
        } else {
            $data .= '<tr><td colspan="6">No Record Found.</td></tr>';
        }
        $data .= '</tbody><tfoot><tr><th>Sr#</th><th>Name</th><th>Guard Name</th><th>Created At</th><th>Updated At</th><th>Action</th></tr></tfoot></table>';
        return $data;
    }
    public function saveImage($image, $img)
    {
        $ext = $image->getClientOriginalExtension();
        $ext = strtolower($ext);
        if ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png' || $ext == 'svg' || $ext == 'webp') {
            if (!is_null($img)) {
                $path = public_path($img);
                if (is_file($path)) {
                    unlink($path);
                }
            }
            $path = 'assets/admin/contract/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $i = $image->move($path, $profileImage);
            return $path . $profileImage;
        }
    }
    public function contract($id)
    {
        return view('admin.contract.contract.index', ['contract' => Contract::where('contract_id', $id)->get()]);
    }
    public function editContract($id)
    {
        $this->pageHeading = (($id == 0) ? 'Add Contract' : 'Edit Contract');
        $this->breadcrumbs['javascript:{};'] = ['icon' => 'fa fa-fw fa-money', 'title' => 'Contract'];
        try {
            return view('admin.contract.contract.form', [
                'contract' => Contract::findOrFail($id),

                'action' => route('admin.contract.contract.update', $id),
            ]);
        } catch (Exception $exception) {
            return redirect()->route('admin.dashboard')->with('error', $exception->getMessage());
        }
    }
    public function salary($id)
    {

    }
}
