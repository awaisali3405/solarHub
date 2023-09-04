<?php

namespace App\Http\Controllers\admin;

use App\Models\Cart;
use App\Models\OrderStatus;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;

class OnlineOrderController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->pageTitle = 'order';
        $this->breadcrumbs[route('admin.dashboard')] = ['icon' => 'fa fa-fw fa-home', 'title' => 'Dashboard'];
        $this->breadcrumbs[route('admin.order.index')] = ['icon' => 'fa fa-fw fa-home', 'title' => 'order'];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        try {
            $pending=Cart::where('order_id', '!=', null)->where('status_id',9)->get()->ToArray();
            $completed=Cart::where('order_id', '!=', null)->where('status_id',10)->get()->ToArray();
            $inProccess=Cart::where('order_id', '!=', null)->whereNotIn('status_id',[10,9])->get()->ToArray();
//            dd($pending);
            return view('admin.onlineOrder.index', [
                'pending'=>count($pending),
                'completed'=>count($completed),
                'inProcess'=>count($inProccess),
                'status' => OrderStatus::all(),
                'order' => Cart::where('order_id', '!=', null)->get(),
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
        $pending=Cart::where('order_id', '!=', null)->where('status_id',9)->get()->ToArray();
        $completed=Cart::where('order_id', '!=', null)->where('status_id',10)->get()->ToArray();
        $inProccess=Cart::where('order_id', '!=', null)->whereNotIn('status_id',[10,9])->get()->ToArray();
//        dd($id);
        if ($id==1){

            return view('admin.onlineOrder.index', [
                'pending'=>count($pending),
                'completed'=>count($completed),
                'inProcess'=>count($inProccess),
                'status' => OrderStatus::all(),
                'order' => Cart::where('order_id', '!=', null)->where('status_id',9)->get(),
            ]);
        }elseif ($id==2){

            return view('admin.onlineOrder.index', [
                'pending'=>count($pending),
                'completed'=>count($completed),
                'inProcess'=>count($inProccess),
                'status' => OrderStatus::all(),
                'order' => Cart::where('order_id', '!=', null)->whereNotIn('status_id',[10,9])->get(),
            ]);
        }else{

            return view('admin.onlineOrder.index', [
                'pending'=>count($pending),
                'completed'=>count($completed),
                'inProcess'=>count($inProccess),
                'status' => OrderStatus::all(),
                'order' => Cart::where('order_id', '!=', null)->where('status_id',10)->get(),
            ]);
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
        $this->pageHeading = (($id == 0) ? 'Add order' : 'Edit order');
        $this->breadcrumbs['javascript:{};'] = ['icon' => 'fa fa-fw fa-money', 'title' => $this->pageHeading];

        try {
            return view('admin.order.form', [

                'order' => $this->orderRepository->get($id),
                'product' => Product::all(),
                'action' => route('admin.order.update', $id),
            ]);
        } catch (Exception $exception) {
            return redirect()->route('admin.dashboard')->with('error', $exception->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param orderRequest $request
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $orderRequest, $id)
    {
        $data = $orderRequest->only('name', 'product_id', 'quantity', 'description');
        try {
            $this->orderRepository->save($data, $id);
            $message = $id > 0 ? 'Order Updated Successfully' : 'order Added Successfully';
            return redirect(route('admin.order.index'))->with('success', $message);
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
            $this->orderRepository->destroy($id);
            $data = $this->all();
            return response()->json(['msg' => 'order deleted successfully.', 'data' => $data]);
        } catch (Exception $exception) {
            return response()->json(['msg' => 'order Not Found.']);
        }
    }

    private function all(): string
    {
        $order = $this->orderRepository->all();
        $data = '<table id="dataTable" class="table table-striped" style="width:100%"><thead><tr><th>Sr#</th><th>Name</th><th>Guard Name</th><th>Created At</th><th>Updated At</th><th>Action</th></tr></thead><tbody>';
        if (count($order) > 0) {
            foreach ($order as $key => $val) {
                $data .= '<tr><td class="width-10">' . ($key + 1) . '</td>';
                $data .= '<td class="width-20">' . $val->name . '</td>';
                $data .= '<td class="width-20">' . $val->guard_name . '</td>';
                $data .= '<td class="width-15">' . $val->created_at . '</td>';
                $data .= '<td class="width-15">' . $val->updated_at . '</td>';
                $data .= '<td class="width-20"><a href="' . route('admin.order.edit', $val->id) . '" title="Edit"><i class="fa fa-edit"></i></a> <a href="javascript:{};" data-url="' . route('admin.order.destroy', $val->id) . '" title="Delete" class="delete"><i class="fa fa-trash"></i></a></td></tr>';
            }
        } else {
            $data .= '<tr><td colspan="6">No Record Found.</td></tr>';
        }
        $data .= '</tbody><tfoot><tr><th>Sr#</th><th>Name</th><th>Guard Name</th><th>Created At</th><th>Updated At</th><th>Action</th></tr></tfoot></table>';
        return $data;
    }
    public function orderStatus(Request $request, $id)
    {

        Cart::where('id', $id)->update(['status_id' => $request->status_id]);
        return redirect()->back()->with('success', 'Status Updated Successfully');
    }
}
