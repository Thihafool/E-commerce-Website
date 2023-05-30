<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderList;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    //add to cart
    public function addToCart(Request $request)
    {
        // logger($request->all());
        $data = $this->getOrderData($request);
        Cart::create($data);
        $response = [
            'message' => 'add to cart complete',
            'status' => 'success',
        ];

        return response()->json($response, 200);

    }

    //order
    public function order(Request $request)
    {
        $total = 0;
        foreach ($request->all() as $item) {
            $data = OrderList::create([
                'user_id' => $item['user_id'],
                'product_id' => $item['product_id'],
                'qty' => $item['qty'],
                'total' => $item['total'],
                'order_code' => $item['order_code'],
            ]);
            $total += $data->total;
        }
        Cart::where('user_id', Auth::user()->id)->delete();

        Order::create([
            'user_id' => Auth::user()->id,
            'order_code' => $data->order_code,
            'total_price' => $total + 5000,
        ]);

        return response()->json([
            'status' => 'true',
            'message' => 'order complete',
        ], 200);

    }

    //clear cart
    public function clearCart()
    {
        Cart::where('user_id', Auth::user()->id)->delete();
        return response()->json();
    }
    //clear current item
    public function clearCurrent(Request $request)
    {
        logger($request->all());
        Cart::where('user_id', Auth::user()->id)
            ->where('product_id', $request->productId)
            ->where('id', $request->orderId)

            ->delete();
    }
    public function changeRole(Request $request)
    {

        $updateSource = [
            'role' => $request->role,
        ];
        User::where('id', $request->userId)->update($updateSource);

    }

    public function userRole(Request $request)
    {

        User::where('id', $request->userId)->update(['role' => $request->role]);
    }

    //increase product view count
    public function increaseviewCount(Request $request)
    {
        $product = Product::where('id', $request->productId)->first();

        $viewCount = [
            'view_count' => $product->view_count + 1,
        ];
        Product::where('id', $request->productId)->update($viewCount);
    }

    //get order data
    private function getOrderData($request)
    {
        return [
            'user_id' => $request->userId,
            'product_id' => $request->productId,
            'qty' => $request->count,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }

}