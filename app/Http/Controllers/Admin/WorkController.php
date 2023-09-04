<?php

namespace App\Http\Controllers\Admin;

use App\Http\Repositories\WorkRepository;

use App\Models\Employee;
use App\Models\Work;
use App\Models\PayTerm;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;

class WorkController extends Controller
{

    private WorkRepository $workRepository;
    public function __construct(WorkRepository $workRepository)
    {
        parent::__construct();
        $this->workRepository = $workRepository;
        $this->pageTitle = 'work';
        $this->breadcrumbs[route('admin.dashboard')] = ['icon' => 'fa fa-fw fa-home', 'title' => 'Dashboard'];
        $this->breadcrumbs[route('admin.work.index')] = ['icon' => 'fa fa-fw fa-home', 'title' => 'work'];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\works\Foundation\Application|\Illuminate\works\View\Factory|\Illuminate\works\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        try {
            return view('admin.work.index', [
                'work' => $this->workRepository->all(),
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
            return view('admin.work.index', [
                'work' => $this->workRepository->show($id),
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
     * @return \Illuminate\works\Foundation\Application|\Illuminate\works\View\Factory|\Illuminate\works\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit($id)
    {
        $this->pageHeading = 'Add work';
        $this->breadcrumbs['javascript:{};'] = ['icon' => 'fa fa-fw fa-money', 'title' => $this->pageHeading];
        try {
            $employee = Employee::findOrFail($id);
            return view('admin.work.form', [
                'employee' => $employee,

                'product' => Product::where('category_id', 1)->get(),
                'action' => route('admin.work.update', 0),
            ]);
        } catch (Exception $exception) {
            return redirect()->route('admin.dashboard')->with('error', $exception->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param workRequest $request
     * @param int $id
     * @return \Illuminate\works\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $workRequest, $id)
    {
        // dd($workRequest);
        $data = $workRequest->except('_token', '_method');
        try {

            // dd($data);
            $this->workRepository->save($data, $id);
            $message = $id > 0 ? 'work Updated Successfully' : 'work Added Successfully';
            return redirect(route('admin.work.show', $data['employee_id']))->with('success', $message);
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
            $this->workRepository->destroy($id);
            $data = $this->all();
            return response()->json(['msg' => 'work deleted successfully.', 'data' => $data]);
        } catch (Exception $exception) {
            return response()->json(['msg' => 'work Not Found.']);
        }
    }

    private function all(): string
    {
        $work = $this->workRepository->all();
        $data = '<table id="dataTable" class="table table-striped" style="width:100%"><thead><tr><th>Sr#</th><th>Name</th><th>Guard Name</th><th>Created At</th><th>Updated At</th><th>Action</th></tr></thead><tbody>';
        if (count($work) > 0) {
            foreach ($work as $key => $val) {
                $data .= '<tr><td class="width-10">' . ($key + 1) . '</td>';
                $data .= '<td class="width-20">' . $val->name . '</td>';
                $data .= '<td class="width-20">' . $val->guard_name . '</td>';
                $data .= '<td class="width-15">' . $val->created_at . '</td>';
                $data .= '<td class="width-15">' . $val->updated_at . '</td>';
                $data .= '<td class="width-20"><a href="' . route('admin.work.edit', $val->id) . '" title="Edit"><i class="fa fa-edit"></i></a> <a href="javascript:{};" data-url="' . route('admin.work.destroy', $val->id) . '" title="Delete" class="delete"><i class="fa fa-trash"></i></a></td></tr>';
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
            $path = 'assets/admin/work/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $i = $image->move($path, $profileImage);
            return $path . $profileImage;
        }
    }
    public function work($id)
    {
        return view('admin.work.work.index', ['work' => work::where('work_id', $id)->get()]);
    }
    public function editwork($id)
    {
        $this->pageHeading = (($id == 0) ? 'Add work' : 'Edit work');
        $this->breadcrumbs['javascript:{};'] = ['icon' => 'fa fa-fw fa-money', 'title' => 'work'];
        try {
            return view('admin.work.work.form', [
                'work' => work::findOrFail($id),

                'action' => route('admin.work.work.update', $id),
            ]);
        } catch (Exception $exception) {
            return redirect()->route('admin.dashboard')->with('error', $exception->getMessage());
        }
    }
    public function salary($id)
    {

    }
}
