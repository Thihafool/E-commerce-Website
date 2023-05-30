<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //direct create page
    public function createPage()
    {
        $category = Category::get();
        return view('admin.product.create', compact('category'));
    }
    //product create
    public function create(Request $request)
    {

        $this->productValidationCheck($request);

        $product = $this->getProductData($request);

        $fileName = uniqid() . $request->file('productImage')->getClientOriginalName();
        $request->file('productImage')->storeAs('public/' . $fileName);
        $product['image'] = $fileName;

        $products = Product::create($product);
        return redirect()->route('product#list', compact('products'))->with(['createSuccess' => 'Product created successfully']);

    }
    //product list
    function list() {
        $products = Product::paginate(5);
        return view('admin.product.list', compact('products'));
    }

    //delete product
    public function delete($id)
    {
        Product::where('id', $id)->delete();
        return back()->with(['deleteSuccess' => 'Product deleted successfully']);
    }

    //direct edit page
    public function edit($id)
    {
        $category = Category::get();
        $product = Product::where('id', $id)->first();
        return view('admin.product.edit', compact('product', 'category'));
    }

    //product update
    public function update(Request $request)
    {
        $id = $request->productId;

        $this->productValidationCheck($request);
        $data = $this->getProductData($request);

        if ($request->hasFile('productImage')) {

            $dbOldImage = Product::where('id', $id)->first();
            $dbOldImage = $dbOldImage->image;

            if ($dbOldImage != null) {
                Storage::delete('public/' . $dbOldImage);
            }
            $fileName = uniqid() . $request->file('productImage')->getClientOriginalName();
            $request->file('productImage')->storeAs('public', $fileName);
            $data['image'] = $fileName;

        }

        Product::where('id', $id)->update($data);

        return redirect()->route('product#list')->with(['updateSuccess' => 'Product updated successfully']);
    }

    private function getProductData($request)
    {
        return [
            'name' => $request->productName,
            'description' => $request->productDescription,
            'price' => $request->productPrice,
            'category_id' => $request->productCategory,
            'waiting_time' => $request->productWaitingTime,
        ];

    }
    private function productValidationCheck($request)
    {
        Validator::make($request->all(), [
            'productName' => 'required|unique:products,name,' . $request->productId,
            'productDescription' => 'required',
            'productPrice' => 'required',
            'productWaitingTime' => 'required',
        ])->validate();
    }
}