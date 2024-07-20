<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductsRequest;
use App\Models\CategoryModel;
use App\Models\ProductsModel;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        return view('project.products.index');
    }

    public function list_products_ajax(Request $request){
        $data = ProductsModel::query();
        $data = $data->get();
        return response()->json([
            'success' => true,
            'view' => view('project.products.ajax.list_products',['data'=>$data])->render()
        ]);
    }

    public function add()
    {
        $category = CategoryModel::get();
        return view('project.products.add',['category'=>$category]);
    }

    public function create(ProductsRequest $request)
    {
        $data = new ProductsModel();
        $data->name = $request->name;
        $data->price = $request->price;
        $data->category_id = $request->category_id;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->storeAs('product', $filename, 'public');
            $data->image = $filename;
        }
            $data->status = 'active';
        if ($data->save()){
            return redirect()->route('product.index')->with(['success'=>'تم اضافة المنتج بنجاح']);
        }
    }
}
