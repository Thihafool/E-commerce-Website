<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderList;
use App\Models\Product;
use App\Models\User;

class RouteController extends Controller
{
    //get all product list
    public function productList()
    {
        $products = Product::get();
        $users = User::get();
        $orders = Order::get();

        $data = [
            'product' => $products,
            'user' => $users,
            'order' => $orders,
        ];
        return response()->json($data, 200);
    }

    public function categoryList()
    {
        $category = Category::get();

        return response()->json($category, 200);
    }
    public function orderList()
    {
        $orderList = OrderList::get();
        $products = Product::get();

        $data = [
            'order' => [
                'orderList' => [
                    'test' => $orderList,
                ],
            ],
            'products' => $products,
        ];
        return $data['order']['orderList']['test'][0]->id;
        return response()->json($data, 200);
    }
}
