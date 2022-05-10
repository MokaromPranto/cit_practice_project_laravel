<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Shipping;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cart(Request $request)
    {

        $shippings = Shipping::groupBy('country_id')->select('country_id')->get();
        $carts = Cart::where('user_id', auth()->id())->get();
        return view('frontend.cart', compact('carts', 'shippings'));
    }
    public function removecart(Cart $cart)
    {
        $cart->delete();
        return back();
    }
    public function clearcart()
    {
        Cart::where('user_id', auth()->id())->delete();
        return back();
    }
    public function updatecart(Request $request)
    {
        foreach ($request->cart_item as $cart_id => $user_stock_ammount) {
            Cart::find($cart_id)->update([
                'user_stock_ammount' => $user_stock_ammount,
            ]);
        }
        return back();
    }
}
