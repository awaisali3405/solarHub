<?php

namespace App\Http\Controllers\Admin;

use App\Http\Repositories\EmployeeRepository;

use App\Models\Contract;
use App\Models\PayTerm;
use Exception;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{

    private EmployeeRepository $employeeRepository;
    public function __construct(EmployeeRepository $employeeRepository)
    {
        parent::__construct();
        $this->employeeRepository = $employeeRepository;
        $this->pageTitle = 'employee';
        $this->breadcrumbs[route('admin.dashboard')] = ['icon' => 'fa fa-fw fa-home', 'title' => 'Dashboard'];
        $this->breadcrumbs[route('admin.employee.index')] = ['icon' => 'fa fa-fw fa-home', 'title' => 'employee'];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        try {
            return view('admin.employee.index', [
                'employee' => $this->employeeRepository->all(),
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
        $this->pageHeading = "Show Eployee";
        $this->breadcrumbs['javascript:{};'] = ['icon' => 'fa fa-fw fa-money', 'title' => $this->pageHeading];
        try {
            return view('admin.employee.show', [
                'employee' => $this->employeeRepository->get($id),
                'action' => route('admin.employee.update', $id),
            ]);
        } catch (Exception $exception) {
            return redirect()->route('admin.dashboard')->with('error', $exception->getMessage());
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
        $this->pageHeading = (($id == 0) ? 'Add employee' : 'Edit employee');
        $this->breadcrumbs['javascript:{};'] = ['icon' => 'fa fa-fw fa-money', 'title' => $this->pageHeading];
        try {
            return view('admin.employee.form', [
                'employee' => $this->employeeRepository->get($id),
                'pay_term' => PayTerm::all(),
                'action' => route('admin.employee.update', $id),
            ]);
        } catch (Exception $exception) {
            return redirect()->route('admin.dashboard')->with('error', $exception->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param employeeRequest $request
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $employeeRequest, $id)
    {
        // dd($employeeRequest);
        $data = $employeeRequest->except('_token', '_method');
        try {
            if (isset($data['img'])) {
                $data['img'] = $this->saveImage($data['img'], $data['img']);
            }
            $this->employeeRepository->save($data, $id);
            // dd($data);
            $message = $id > 0 ? 'Employee Updated Successfully' : 'Employee Added Successfully';
            return redirect(route('admin.employee.index'))->with('success', $message);
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
            $this->employeeRepository->destroy($id);
            $data = $this->all();
            return response()->json(['msg' => 'employee deleted successfully.', 'data' => $data]);
        } catch (Exception $exception) {
            return response()->json(['msg' => 'employee Not Found.']);
        }
    }

    private function all(): string
    {
        $employee = $this->employeeRepository->all();
        $data = '<table id="dataTable" class="table table-striped" style="width:100%"><thead><tr><th>Sr#</th><th>Name</th><th>Guard Name</th><th>Created At</th><th>Updated At</th><th>Action</th></tr></thead><tbody>';
        if (count($employee) > 0) {
            foreach ($employee as $key => $val) {
                $data .= '<tr><td class="width-10">' . ($key + 1) . '</td>';
                $data .= '<td class="width-20">' . $val->name . '</td>';
                $data .= '<td class="width-20">' . $val->guard_name . '</td>';
                $data .= '<td class="width-15">' . $val->created_at . '</td>';
                $data .= '<td class="width-15">' . $val->updated_at . '</td>';
                $data .= '<td class="width-20"><a href="' . route('admin.employee.edit', $val->id) . '" title="Edit"><i class="fa fa-edit"></i></a> <a href="javascript:{};" data-url="' . route('admin.employee.destroy', $val->id) . '" title="Delete" class="delete"><i class="fa fa-trash"></i></a></td></tr>';
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
            $path = 'assets/admin/employee/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $i = $image->move($path, $profileImage);
            return $path . $profileImage;
        }
    }
    public function contract($id)
    {
        return view('admin.employee.contract.index', ['contract' => Contract::where('employee_id', $id)->get()]);
    }
    public function editContract($id)
    {
        $this->pageHeading = (($id == 0) ? 'Add Contract' : 'Edit Contract');
        $this->breadcrumbs['javascript:{};'] = ['icon' => 'fa fa-fw fa-money', 'title' => 'Contract'];
        try {
            return view('admin.employee.contract.form', [
                'contract' => Contract::findOrFail($id),

                'action' => route('admin.employee.contract.update', $id),
            ]);
        } catch (Exception $exception) {
            return redirect()->route('admin.dashboard')->with('error', $exception->getMessage());
        }
    }
    public function salary($id)
    {

    }
}
