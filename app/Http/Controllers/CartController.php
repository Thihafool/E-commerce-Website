<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    //driect cart list
    public function cartPage()
    {
        $cartList = Cart::select('carts.*', 'products.name as product_name', 'products.price as product_price', 'products.image as product_image')
            ->leftJoin('products', 'products.id', 'carts.product_id')
            ->where('carts.user_id', Auth::user()->id)->get();
        $totalPrice = 0;
        foreach ($cartList as $c) {
            $totalPrice += $c->product_price * $c->qty;
        }

        return view('user.wishCart.cart', compact('cartList', 'totalPrice'));
    }

    //direct history page
    public function history()
    {
        $order = Order::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(2);
        return view('user.wishCart.history', compact('order'));
    }

    //direct product details
    public function details($id)
    {
        $product = Product::where('id', $id)->first();
        $products = Product::get();
        return view('user.product.details', compact('product', 'products'));
    }
}