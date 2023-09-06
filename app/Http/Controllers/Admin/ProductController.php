<?php

namespace App\Http\Controllers\Admin;

use App\Http\Repositories\ProductRepository;

use App\Models\Cart;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Unit;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    private ProductRepository $productRepository;
    public function __construct(ProductRepository $productRepository)
    {
        parent::__construct();
        $this->productRepository = $productRepository;
        $this->pageTitle = 'product';
        $this->breadcrumbs[route('admin.dashboard')] = ['icon' => 'fa fa-fw fa-home', 'title' => 'Dashboard'];
        $this->breadcrumbs[route('admin.product.index')] = ['icon' => 'fa fa-fw fa-home', 'title' => 'product'];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        try {
            return view('admin.product.index', [
                'product' => $this->productRepository->all(),
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
        $product = $this->productRepository->get($id);

        if ($product->status == 1) {

            $data['status'] = 0;
            $message = 'Product De-activated Successfully';
        } else {

            $data['status'] = 1;
            $message = 'Product Activated Successfully';
        }
        $this->productRepository->save($data, $id);
        return redirect(route('admin.product.index'))->with('success', $message);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit($id)
    {
        $this->pageHeading = (($id == 0) ? 'Add product' : 'Edit product');
        $this->breadcrumbs['javascript:{};'] = ['icon' => 'fa fa-fw fa-money', 'title' => $this->pageHeading];
        try {
            return view('admin.product.form', [
                'product' => $this->productRepository->get($id),
               
                'action' => route('admin.product.update', $id),
            ]);
        } catch (Exception $exception) {
            return redirect()->route('admin.dashboard')->with('error', $exception->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param productRequest $request
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $productRequest, $id)
    {

        $data = $productRequest->except('_token', '_method');
        // dd($productRequest);
        if ((isset($data['img']))) {
            $data['img'] = $this->saveImage($data['img'], $data['img']);
        }
        unset($data['image']);
        $this->productRepository->save($data, $id);
        try {
            $message = $id > 0 ? 'product Updated Successfully' : 'product Added Successfully';
            return redirect(route('admin.product.index'))->with('success', $message);
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
            $this->productRepository->destroy($id);
            $data = $this->all();
            return response()->json(['msg' => 'product deleted successfully.', 'data' => $data]);
        } catch (Exception $exception) {
            return response()->json(['msg' => 'product Not Found.']);
        }
    }

    private function all(): string
    {
        $product = $this->productRepository->all();
        $data = '<table id="dataTable" class="table table-striped" style="width:100%"><thead><tr><th>Sr#</th><th>Name</th><th>Guard Name</th><th>Created At</th><th>Updated At</th><th>Action</th></tr></thead><tbody>';
        if (count($product) > 0) {
            foreach ($product as $key => $val) {
                $data .= '<tr><td class="width-10">' . ($key + 1) . '</td>';
                $data .= '<td class="width-20">' . $val->name . '</td>';
                $data .= '<td class="width-20">' . $val->guard_name . '</td>';
                $data .= '<td class="width-15">' . $val->created_at . '</td>';
                $data .= '<td class="width-15">' . $val->updated_at . '</td>';
                $data .= '<td class="width-20"><a href="' . route('admin.product.edit', $val->id) . '" title="Edit"><i class="fa fa-edit"></i></a> <a href="javascript:{};" data-url="' . route('admin.product.destroy', $val->id) . '" title="Delete" class="delete"><i class="fa fa-trash"></i></a></td></tr>';
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
            $path = 'assets/front/uploads/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $i = $image->move($path, $profileImage);
            return $path . $profileImage;
        }
    }
}
