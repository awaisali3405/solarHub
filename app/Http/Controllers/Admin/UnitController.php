<?php

namespace App\Http\Controllers\Admin;

use App\Http\Repositories\unitRepository;
use App\Http\Requests\UnitRequest;
use Exception;
use Illuminate\Http\Request;

class UnitController extends Controller
{

    private UnitRepository $unitRepository;
    public function __construct(UnitRepository $unitRepository)
    {
        parent::__construct();
        $this->unitRepository = $unitRepository;
        $this->pageTitle = 'unit';
        $this->breadcrumbs[route('admin.dashboard')] = ['icon' => 'fa fa-fw fa-home', 'title' => 'Dashboard'];
        $this->breadcrumbs[route('admin.unit.index')] = ['icon' => 'fa fa-fw fa-home', 'title' => 'unit'];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        try {
            return view('admin.unit.index', [
                'unit' => $this->unitRepository->all(),
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
        $this->pageHeading = (($id == 0) ? 'Add unit' : 'Edit unit');
        $this->breadcrumbs['javascript:{};'] = ['icon' => 'fa fa-fw fa-money', 'title' => $this->pageHeading];
        try {
            return view('admin.unit.form', [
                'unit' => $this->unitRepository->get($id),

                'action' => route('admin.unit.update', $id),
            ]);
        } catch (Exception $exception) {
            return redirect()->route('admin.dashboard.index')->with('error', $exception->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param unitRequest $request
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $unitRequest, $id)
    {
        $data = $unitRequest->only('name', 'unit');
        // $data['status'] = 1;
        try {
            $this->unitRepository->save($data, $id);
            $message = $id > 0 ? 'unit Updated Successfully' : 'unit Added Successfully';
            return redirect(route('admin.unit.index'))->with('success', $message);
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
            $this->unitRepository->destroy($id);
            $data = $this->all();
            return response()->json(['msg' => 'unit deleted successfully.', 'data' => 'asa']);
        } catch (Exception $exception) {
            return response()->json(['msg' => 'unit Not Found.']);
        }
    }

    private function all(): string
    {
        $unit = $this->unitRepository->all();
        $data = '<table id="dataTable" class="table table-striped" style="width:100%"><thead>
        <tr>
            <th>Sr#</th>
            <th>Name</th>
            <th>Unit</th>
            <th>Status</th>
            <th>Action</th>

        </tr>
    </thead><tbody>';
        if (count($unit) > 0) {
            foreach ($unit as $key => $val) {
                $data .= '<tr>
                <td>' . $key + 1 . ' </td>
                <td>' . $val->name . '</td>
                <td>' . $val->unit . '</td>
                <td> ' . $val->status . ' </td>
                <td>
                    <a href=" ' . route("admin.unit.edit", $val->id) . '" title="Edit"><i
                            style="font-size: 1.5rem" class="mdi mdi-table-edit"></i></a>
                    <a href="javascript:{};"
                        data-url="' . route('admin.unit.destroy', $val->id) . '" title="Delete"
                        class="delete"><i class="mdi mdi-delete" style="font-size: 1.5rem"></i></a>
                </td>
            </tr>';
            }
        } else {
            $data .= '<tr><td colspan="6">No Record Found.</td></tr>';
        }
        $data .= '</tbody><tfoot>    <tr>
        <th>Sr#</th>
        <th>Name</th>
        <th>Unit</th>
        <th>Status</th>
        <th>Action</th>

    </tr></tfoot></table>';
        return $data;
    }
}
