<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use App\Traits\ImageUpload;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use ImageUpload;
    public function index(Request $request)
    {

        $products = ProductResource::collection(Product::get());
        return response()->json(['products' => $products]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStoreRequest $request)
    {
        $data = $request->validated();
        $data = $this->UserImageUpload($data,$request,'public/product-images');
        $products = Product::create($data);
        if ($products) {
            return response()->json([
                'succes' => true,
                'data' => $products,
                'msg' => "Product Created Success"
            ]);
        }
        else {
            return response()->json([
                'succes' => false,
                'data' => [],
                'msg' => 'Error'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return response()->json(['products' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $request, Product $product)
    {
        $data = $request->validated();
        $data = $this->UserImageUpload($data, $request,'public/product-images', $product);
        $product->update($data);
        if ($product) {
            return response()->json([
                'succes' => true,
                'data' => new ProductResource($product),
                'msg' => "Product Updated Success"
            ]);
        }
        else {
            return response()->json([
                'succes' => false,
                'data' => [],
                'msg' => 'Error'
            ]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json([
            'succes' => true,
            'msg' => "Product Deleted Success"
        ]);
    }
}
