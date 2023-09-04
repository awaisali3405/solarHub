<?php

namespace App\Http\Controllers\Admin;

use App\Http\Repositories\SettingsRepository;
use App\Http\Requests\SettingRequest;
use Exception;

class SettingsController extends Controller
{
    private SettingsRepository $settingsRepository;
    public function __construct(SettingsRepository $settingsRepository)
    {
        parent::__construct();
        $this->settingsRepository = $settingsRepository;
        $this->pageTitle = 'Setting';
        $this->breadcrumbs[route('admin.dashboard')] = ['icon' => 'fa fa-fw fa-home', 'title' => 'Dashboard'];
        $this->breadcrumbs[route('admin.settings.index')] = ['icon' => 'fa fa-fw fa-home', 'title' => 'Settings'];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        try{
            $settings = $this->settingsRepository->all();
            return view('admin.settings.index', [
                'settings' => $settings,
            ]);
        } catch (Exception $exception){
            return redirect()->route('admin.dashboard')->with('error', $exception->getMessage());
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(SettingRequest $request)
    {

    }

    public function show($id)
    {

    }

    public function edit($key)
    {
        $this->pageHeading = (($key == 'null') ? 'Add Setting' : 'Edit Setting');
        $this->breadcrumbs['javascript:{};'] = ['icon' => 'fa fa-fw fa-money', 'title' => $this->pageHeading];
        return view('admin.settings.form', [
            'setting' => $this->settingsRepository->get($key),
            'action' => route('admin.settings.update', $key),
        ]);
    }

    public function update(SettingRequest $request, $id)
    {
        try{
            $this->settingsRepository->save($request->only('key', 'value', 'old'), $id);
        } catch (Exception $exception){
            return redirect()->route('admin.settings.index')->with('error', $exception->getMessage());
        }
        if ($id == 'null') {
            return redirect(route('admin.settings.index'))->with('success', 'New Setting Added Successfully.');
        } else {
            return redirect(route('admin.settings.index'))->with('success', 'Setting Updated Successfully.');
        }
    }

    public function destroy($key): \Illuminate\Http\JsonResponse
    {
        try {
            $this->settingsRepository->destroy($key);
            $data = $this->all();
            return response()->json(['msg' => 'Setting value deleted successfully.', 'data' => $data]);
        } catch (Exception $exception){
            return response()->json(['msg' => 'Value Not Found.']);
        }
    }

    public function arrayFlatten($array, $netKey='') {
        if (!is_array($array)) {
            return $array;
        }
        $result = array();
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $result = array_merge($result,$this->arrayFlatten($value,$netKey.$key.'.'));
            }
            else {
                $result[$netKey.$key] = $value;
            }
        }
        return $result;
    }

    private function all(): string
    {
        $settings = $this->settingsRepository->all();
        $data = '<table id="dataTable" class="table table-striped" style="width:100%"><thead><tr><th>Sr#</th><th>Name</th><th>Value</th><th>Action</th></tr></thead><tbody>';
        if(count($settings) > 0){
            $i = 1;
            foreach ($settings as $key => $val){
                $data .= '<tr><td class="width-10">'.$i.'</td>';
                $data .= '<td class="width-40">'.$key.'</td>';
                $data .= '<td class="width-30">'.$val.'</td>';
                $data .= '<td class="width-20"><a href="'.route('admin.settings.edit', $key).'" title="Edit"><i class="fa fa-edit"></i></a> <a href="javascript:{};" data-url="'.route('admin.settings.destroy',  $key).'" title="Delete" class="delete"><i class="fa fa-trash"></i></a></td></tr>';
                $i++;
            }
        } else{
            $data .= '<tr><td colspan="4">No Record Found.</td></tr>';
        }
        $data .= '</tbody><tfoot><tr><th>Sr#</th><th>Name</th><th>Value</th><th>Action</th></tr></tfoot></table>';
        return $data;
    }

    private function getView($key = null, $id = 0)
    {
        $this->heading = (($key == null) ? 'Add Setting' : 'Edit Setting');
        $this->breadcrumbs['javascript:{};'] = ['icon' => 'fa fa-fw fa-money', 'title' => $this->heading];
        return view('admin.settings.index', [
            'id' => $id,
            'settings' => $this->all(),
            'setting' => $this->getParams($key),
            'action' => route('setting.store'),
        ]);
    }
}
