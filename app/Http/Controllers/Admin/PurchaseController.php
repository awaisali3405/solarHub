<?php

namespace App\Http\Controllers\Admin;

use App\Http\Repositories\PurchaseRepository;

use App\Models\Product;
use App\Models\PurchaseProduct;
use App\Models\Supplier;
use Exception;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{

    private PurchaseRepository $purchaseRepository;
    public function __construct(PurchaseRepository $purchaseRepository)
    {
        parent::__construct();
        $this->purchaseRepository = $purchaseRepository;
        $this->pageTitle = 'purchase';
        $this->breadcrumbs[route('admin.dashboard')] = ['icon' => 'fa fa-fw fa-home', 'title' => 'Dashboard'];
        $this->breadcrumbs[route('admin.purchase.index')] = ['icon' => 'fa fa-fw fa-home', 'title' => 'purchase'];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        try {
            return view('admin.purchase.index', [
                'purchase' => $this->purchaseRepository->all(),
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
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

            $this->purchaseRepository->destroy($id);
            $data = "purchase deleted successfully.";
            return redirect(route('admin.purchase.index'))->with('success',$data);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit($id)
    {
        $this->pageHeading = (($id == 0) ? 'Add purchase' : 'Edit purchase');
        $this->breadcrumbs['javascript:{};'] = ['icon' => 'fa fa-fw fa-money', 'title' => $this->pageHeading];
        try {
            return view('admin.purchase.form', [
                'purchase' => $this->purchaseRepository->get($id),
                'supplier' => Supplier::all(),
                'product' => Product::all(),
                'action' => route('admin.purchase.update', $id),
            ]);
        } catch (Exception $exception) {
            return redirect()->route('admin.dashboard.index')->with('error', $exception->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param purchaseRequest $request
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $purchaseRequest, $id)
    {
        $data = $purchaseRequest->except('_token', '_method');
        $data2 = $purchaseRequest->only('supplier_id', 'discount', 'gst_tax', 'wht_tax', 'status', 'paid', 'total');
        // $data['purchase_id'] = 1;
        // dd($data);
        // dd($purchase->id);
        try {
            if ($purchaseRequest->status == 'paid') {
                $data2['paid'] = $data2['total'];
            }
            $purchase = $this->purchaseRepository->save($data2, $id);
            PurchaseProduct::where('purchase_id', $purchase->id)->delete();

            foreach ($data['product_id'] as $key => $value) {
                $product = new PurchaseProduct();
                $product->purchase_id = $purchase->id;
                $product->product_id = $data['product_id'][$key];
                $product->quantity = $data['quantity'][$key];
                $product->price = $data['price'][$key];
                $product->save();
            }


            $message = $id > 0 ? 'purchase Updated Successfully' : 'purchase Added Successfully';
            return redirect(route('admin.purchase.index'))->with('success', $message);
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

    }

    private function all(): string
    {
        $purchase = $this->purchaseRepository->all();
        $data = '<table id="dataTable" class="table table-striped" style="width:100%"><thead><tr><th>Sr#</th><th>Name</th><th>Guard Name</th><th>Created At</th><th>Updated At</th><th>Action</th></tr></thead><tbody>';
        if (count($purchase) > 0) {
            foreach ($purchase as $key => $val) {
                $data .= '<tr><td class="width-10">' . ($key + 1) . '</td>';
                $data .= '<td class="width-20">' . $val->name . '</td>';
                $data .= '<td class="width-20">' . $val->guard_name . '</td>';
                $data .= '<td class="width-15">' . $val->created_at . '</td>';
                $data .= '<td class="width-15">' . $val->updated_at . '</td>';
                $data .= '<td class="width-20"><a href="' . route('admin.purchase.edit', $val->id) . '" title="Edit"><i class="fa fa-edit"></i></a> <a href="javascript:{};" data-url="' . route('admin.purchase.destroy', $val->id) . '" title="Delete" class="delete"><i class="fa fa-trash"></i></a></td></tr>';
            }
        } else {
            $data .= '<tr><td colspan="6">No Record Found.</td></tr>';
        }
        $data .= '</tbody><tfoot><tr><th>Sr#</th><th>Name</th><th>Guard Name</th><th>Created At</th><th>Updated At</th><th>Action</th></tr></tfoot></table>';
        return $data;
    }
    public function addProduct()
    {
        $product = Product::where('category_id', 1)->get();
        $output = '<tr class="line_items text-center" style="margin-top:5px;">
        <td><button class="row-remove btn btn-danger "
                style=" margin-right:20px">Remove</button></td>
        <td> <select class="form-control product_name" style="margin-top: 11px;"
                name="product_id[]" required>
                <option value="">Select Product</option>';

        foreach ($product as $value2) {
            $output .= '<option value="' . $value2 . '"> ' . $value2->name . ' </option>';

        }
        $output .= '</select></td>
        <td><input type="number" step="any" class="form-control product_quantity"
                style="    margin-top: 11px;" name="quantity[]" value=""></td>
        <td><input type="number" step="any" class="form-control product_price"
                style="    margin-top: 11px;" name="price[]" value=""></td>
        <td></td>
        <td><input type="text" class="form-control product_total_price"
                style="    margin-top: 11px;" name="item_total[]" value="" readonly>
        </td>
    </tr>';
        echo $output;
    }

    public function removeProduct(Request $request)
    {
        $id = $request->get('value');
        PurchaseProduct::where('id', $id)->delete();
        echo $id;
    }
}
