<?php

namespace App\Http\Controllers\Admin;

use App\Http\Repositories\PermissionsRepository;
use App\Http\Repositories\RolesRepository;
use App\Http\Requests\RoleRequest;
use Exception;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    private RolesRepository $rolesRepository;
    private PermissionsRepository $permissionsRepository;
    public function __construct(RolesRepository $rolesRepository, PermissionsRepository $permissionsRepository)
    {
        parent::__construct();
        $this->rolesRepository = $rolesRepository;
        $this->permissionsRepository = $permissionsRepository;
        $this->pageTitle = 'Role';
        $this->breadcrumbs[route('admin.dashboard')] = ['icon' => 'fa fa-fw fa-home', 'title' => 'Dashboard'];
        $this->breadcrumbs[route('admin.roles.index')] = ['icon' => 'fa fa-fw fa-home', 'title' => 'Roles'];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        try{
            return view('admin.role.index', [
                'roles' => $this->rolesRepository->all(),
            ]);
        } catch (Exception $exception){
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->pageHeading = (($id == 0) ? 'Add Role' : 'Edit Role');
        $this->breadcrumbs['javascript:{};'] = ['icon' => 'fa fa-fw fa-money', 'title' => $this->pageHeading];
        try{
            return view('admin.role.form', [
                'role' => $this->rolesRepository->get($id),
                'guards' => ['web', 'admins'],
                'permissions' => $this->permissionsRepository->all(),
                'action' => route('admin.roles.update', $id),
            ]);
        } catch (Exception $exception){
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(RoleRequest $roleRequest, $id)
    {
        $data = $roleRequest->only('name', 'guard_name', 'permissions');
        try {
            $this->rolesRepository->save($data, $id);
            $message = $id > 0 ? 'Role Updated Successfully' : 'Role Added Successfully';
            return redirect(route('admin.roles.index'))->with('success', $message);
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
    public function destroy($id): \Illuminate\Http\JsonResponse
    {
        try {
            $this->rolesRepository->destroy($id);
            $data = $this->all();
            return response()->json(['msg' => 'Role deleted successfully.', 'data' => $data]);
        } catch (Exception $exception){
            return response()->json(['msg' => 'Role Not Found.']);
        }
    }

    private function all(): string
    {
        $roles = $this->rolesRepository->all();
        $data = '<table id="dataTable" class="table table-striped" style="width:100%"><thead><tr><th>Sr#</th><th>Name</th><th>Guard Name</th><th>Created At</th><th>Updated At</th><th>Action</th></tr></thead><tbody>';
        if(count($roles) > 0){
            foreach ($roles as $key => $val){
                $data .= '<tr><td class="width-10">'.($key+1).'</td>';
                $data .= '<td class="width-20">'.$val->name.'</td>';
                $data .= '<td class="width-20">'.$val->guard_name.'</td>';
                $data .= '<td class="width-15">'.$val->created_at.'</td>';
                $data .= '<td class="width-15">'.$val->updated_at.'</td>';
                $data .= '<td class="width-20"><a href="'.route('admin.roles.edit', $val->id).'" title="Edit"><i class="fa fa-edit"></i></a> <a href="javascript:{};" data-url="'.route('admin.permissions.destroy',  $val->id).'" title="Delete" class="delete"><i class="fa fa-trash"></i></a></td></tr>';
            }
        } else{
            $data .= '<tr><td colspan="6">No Record Found.</td></tr>';
        }
        $data .= '</tbody><tfoot><tr><th>Sr#</th><th>Name</th><th>Guard Name</th><th>Created At</th><th>Updated At</th><th>Action</th></tr></tfoot></table>';
        return $data;
    }
}
