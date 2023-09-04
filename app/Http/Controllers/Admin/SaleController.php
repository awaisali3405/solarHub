<?php

namespace App\Http\Controllers\Admin;

use App\Http\Repositories\SaleRepository;

use App\Models\Customer;
use App\Models\Product;
use App\Models\saleProduct;
use App\Models\Supplier;
use Exception;
use Illuminate\Http\Request;

class SaleController extends Controller
{

    private SaleRepository $saleRepository;
    public function __construct(SaleRepository $saleRepository)
    {
        parent::__construct();
        $this->saleRepository = $saleRepository;
        $this->pageTitle = 'sale';
        $this->breadcrumbs[route('admin.dashboard')] = ['icon' => 'fa fa-fw fa-home', 'title' => 'Dashboard'];
        $this->breadcrumbs[route('admin.sale.index')] = ['icon' => 'fa fa-fw fa-home', 'title' => 'sale'];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        try {
            return view('admin.sale.index', [
                'sale' => $this->saleRepository->all(),
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
        $this->saleRepository->destroy($id);
        $data = "sale deleted successfully.";
        return redirect(route('admin.sale.index'))->with('success', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit($id)
    {
        $this->pageHeading = (($id == 0) ? 'Add sale' : 'Edit sale');
        $this->breadcrumbs['javascript:{};'] = ['icon' => 'fa fa-fw fa-money', 'title' => $this->pageHeading];
        try {
            return view('admin.sale.form', [
                'sale' => $this->saleRepository->get($id),
                'supplier' => Customer::all(),
                'product' => Product::where('category_id', 1)->get(),
                'action' => route('admin.sale.update', $id),
            ]);
        } catch (Exception $exception) {
            return redirect()->route('admin.dashboard.index')->with('error', $exception->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param saleRequest $request
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $saleRequest, $id)
    {
        $data = $saleRequest->except('_token', '_method');
        $data2 = $saleRequest->only('customer_id', 'discount', 'gst_tax', 'wht_tax', 'status', 'paid', 'total');
        // $data['sale_id'] = 1;
        // dd($data);
        // dd($sale->id);
        try {
            if ($saleRequest->status == 'paid') {
                $data2['paid'] = $data2['total'];
            }
            $sale = $this->saleRepository->save($data2, $id);
            SaleProduct::where('sale_id', $sale->id)->delete();

            foreach ($data['product_id'] as $key => $value) {
                $product = new SaleProduct();
                $product->sale_id = $sale->id;
                $product->product_id = $data['product_id'][$key];
                $product->quantity = $data['quantity'][$key];
                $product->price = $data['price'][$key];
                $product->save();

            }

            $message = $id > 0 ? 'sale Updated Successfully' : 'sale Added Successfully';
            return redirect(route('admin.sale.index'))->with('success', $message);
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
            $this->saleRepository->destroy($id);
            $data = $this->all();
            return response()->json(['msg' => 'sale deleted successfully.', 'data' => $data]);
        } catch (Exception $exception) {
            return response()->json(['msg' => 'sale Not Found.']);
        }
    }

    private function all(): string
    {
        $sale = $this->saleRepository->all();
        $data = '<table id="dataTable" class="table table-striped" style="width:100%"><thead><tr><th>Sr#</th><th>Name</th><th>Guard Name</th><th>Created At</th><th>Updated At</th><th>Action</th></tr></thead><tbody>';
        if (count($sale) > 0) {
            foreach ($sale as $key => $val) {
                $data .= '<tr><td class="width-10">' . ($key + 1) . '</td>';
                $data .= '<td class="width-20">' . $val->name . '</td>';
                $data .= '<td class="width-20">' . $val->guard_name . '</td>';
                $data .= '<td class="width-15">' . $val->created_at . '</td>';
                $data .= '<td class="width-15">' . $val->updated_at . '</td>';
                $data .= '<td class="width-20"><a href="' . route('admin.sale.edit', $val->id) . '" title="Edit"><i class="fa fa-edit"></i></a> <a href="javascript:{};" data-url="' . route('admin.sale.destroy', $val->id) . '" title="Delete" class="delete"><i class="fa fa-trash"></i></a></td></tr>';
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
        saleProduct::where('id', $id)->delete();
        echo $id;
    }
}