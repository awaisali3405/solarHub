<?php

namespace App\Http\Controllers\Admin;

use App\Http\Repositories\ProductRepository;
use App\Http\RepositoriesRecipeRepository;

use App\Models\Category;
use App\Models\Product;
use App\Models\Recipe;
use App\Models\SubCategory;
use App\Models\Unit;
use Exception;
use Illuminate\Http\Request;

class RecipeController extends Controller
{

    private ProductRepository $productRepository;
    // private RecipeRepository $recipeRepository;
    public function __construct(ProductRepository $productRepository)
    {
        parent::__construct();
        $this->productRepository = $productRepository;
        $this->pageTitle = 'recipe';
        $this->breadcrumbs[route('admin.dashboard')] = ['icon' => 'fa fa-fw fa-home', 'title' => 'Dashboard'];
        $this->breadcrumbs[route('admin.recipe.index')] = ['icon' => 'fa fa-fw fa-home', 'title' => 'recipe'];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        try {
            return view('admin.recipe.index', [
                'recipe' => Product::where('category_id', 1)->get(),
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
        $this->pageHeading = (($id == 0) ? 'Add recipe' : 'Edit recipe');
        $this->breadcrumbs['javascript:{};'] = ['icon' => 'fa fa-fw fa-money', 'title' => $this->pageHeading];
        try {
            return view('admin.recipe.form', [
                'product' => $this->productRepository->get($id),
                'raw' => Product::where('category_id', 2)->get(),
                'recipeDetail' => Recipe::where('recipe_product_id', $id)->get(),
                'action' => route('admin.recipe.update', $id),
            ]);
        } catch (Exception $exception) {
            return redirect()->route('admin.dashboard')->with('error', $exception->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param recipeRequest $request
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $recipeRequest, $id)
    {
        $data = $recipeRequest->except('_token', '_method');
        Recipe::where('recipe_product_id', $id)->delete();
        try {
            foreach ($recipeRequest->raw_id as $key => $value) {
                $recipeDetail = new Recipe();
                $recipeDetail->recipe_product_id = $recipeRequest->recipe_product_id;
                $recipeDetail->raw_id = $data['raw_id'][$key];
                $recipeDetail->quantity = $data['quantity'][$key];
                $recipeDetail->save();
            }
            $message = $id > 0 ? 'recipe Updated Successfully' : 'recipe Added Successfully';
            return redirect(route('admin.recipe.index'))->with('success', $message);
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
            return response()->json(['msg' => 'recipe deleted successfully.', 'data' => $data]);
        } catch (Exception $exception) {
            return response()->json(['msg' => 'recipe Not Found.']);
        }
    }

    private function all(): string
    {
        $recipe = $this->productRepository->all();
        $data = '<table id="dataTable" class="table table-striped" style="width:100%"><thead><tr><th>Sr#</th><th>Name</th><th>Guard Name</th><th>Created At</th><th>Updated At</th><th>Action</th></tr></thead><tbody>';
        if (count($recipe) > 0) {
            foreach ($recipe as $key => $val) {
                $data .= '<tr><td class="width-10">' . ($key . 1) . '</td>';
                $data .= '<td class="width-20">' . $val->name . '</td>';
                $data .= '<td class="width-20">' . $val->guard_name . '</td>';
                $data .= '<td class="width-15">' . $val->created_at . '</td>';
                $data .= '<td class="width-15">' . $val->updated_at . '</td>';
                $data .= '<td class="width-20"><a href="' . route('admin.recipe.edit', $val->id) . '" title="Edit"><i class="fa fa-edit"></i></a> <a href="javascript:{};" data-url="' . route('admin.recipe.destroy', $val->id) . '" title="Delete" class="delete"><i class="fa fa-trash"></i></a></td></tr>';
            }
        } else {
            $data .= '<tr><td colspan="6">No Record Found.</td></tr>';
        }
        $data .= '</tbody><tfoot><tr><th>Sr#</th><th>Name</th><th>Guard Name</th><th>Created At</th><th>Updated At</th><th>Action</th></tr></tfoot></table>';
        return $data;
    }
    public function rawProduct()
    {
        $product = Product::where('category_id', 2)->get();
        $data = '';
        $data .= '<div class="mb-3 d-flex product_body" id=""><div class="col-5 d-flex">' .
            '<label for="value" style="margin-bottom: 10px;"></label>' .
            '<select class="form-control" name="raw_id[]">' .
            '<option value="">----Select Raw Product----</option>';
        foreach ($product as $key => $value) {
            $data .= '<option value="' . $value->id . '" >' . $value->name . '</option>';
        }
        $data .= '</select></div><div class="col-5 mx-3 "><input type="number" id="quantity" class="form-control" name="quantity[]" value="" placeholder="Enter Quantity"></div><div class="col-2 "><a href="javascript:void(0);"  class="btn-sm btn-primary btn-rounded remove_product"><i class="mdi mdi-playlist-remove"></i></a></div></div> ';
        echo $data;
    }
    public function removeProduct($id)
    {
        // dd($id);
        Recipe::where("id", $id)->delete();
        // echo "success";
    }
}
