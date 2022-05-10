<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Inventory;
use App\Models\Order_detail;
use App\Models\Post;
use App\Models\Product;
use App\Models\Product_gallery_photo;
use App\Models\Shipping;
use App\Models\Subcategory;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class FrontendController extends Controller
{
    // Index //
    public function index(){
        $categories = Category::all();
        $products = Product::latest()->take(4)->get();
        $total_products = Product::count();
        $all_products = Product::all();
        $on_sale_products = Product::where('product_discounted_price', '!=' , null)->get();
        $not_on_sale_products = Product::where('product_discounted_price', '=' , null)->get();
        $banners = Banner::all();
        $total_cart_item = Cart::where('user_id', auth()->id())->count();
        $carts = Cart::where('user_id', auth()->id())->get();
        $posts = Post::latest()->take(3)->get();
        return view('frontend.index', compact('categories', 'banners','products', 'total_products', 'total_cart_item', 'carts', 'posts', 'all_products', 'on_sale_products', 'not_on_sale_products'));
    }

    // Shop //
    public function shop()
    {
        if(isset($_GET['p'])){
            $products = Product::where('product_name', 'LIKE', '%'.$_GET['p'].'%')
            ->orWhere('product_long_description', 'LIKE', '%'.$_GET['p'].'%')
            ->get();
        }else{
            $products = Product::latest()->get();
        }
        if(isset($_GET['min']) && isset($_GET['max'])){
            $q1 = Product::whereBetween('product_regular_price', [$_GET['min'], $_GET['max']])->get();
            $q2 = Product::whereNull('product_discounted_price')->whereBetween('product_regular_price', [$_GET['min'], $_GET['max']])->get();
            $products = $q1->merge($q2);
        }
        $total_products = Product::count();
        $carts = Cart::where('user_id', auth()->id())->get();
        return view('frontend.shop', compact('products', 'total_products', 'carts'));
    }
    public function blog()
    {
        $posts = Post::all();
        $carts = Cart::where('user_id', auth()->id())->get();
        return view('frontend.blog', compact('posts', 'carts'));
    }
    public function blogdetails(Post $blog_detail)
    {
        $carts = Cart::where('user_id', auth()->id())->get();
        return view('frontend.blog_details', compact('blog_detail', 'carts'));
    }
    // Product Details //
    public function productdetails($slug){
        session()->forget('mhp');
        $product_detail = Product::where('slug', $slug)->first();
        $related_product = Product::where('product_category_id', $product_detail->product_category_id)->where('id', '!=', $product_detail->id)->get();
        $colors = Inventory::where('product_id', $product_detail->id)->groupBy('color_id')->select('color_id')->get();
        $product_gallery_photos = Product_gallery_photo::where('product_id', $product_detail->id)->get();
        $carts = Cart::where('user_id', auth()->id())->get();

        return view('frontend.product_details', compact('product_detail', 'related_product', 'colors', 'product_gallery_photos', 'carts'));
    }

    // Get Size //
    public function getsize(Request $request){
        $strtosend = "<option selected disable>--Select a size--</option>";
        $sizes = Inventory::where([
            'product_id' => $request->product_id,
            'color_id' => $request->color_id
        ])->get();

        foreach ($sizes as $size) {
            $strtosend .= "<option value='". $size->relationwithsize->id ."' >". $size->relationwithsize->size_name ."</option>";
        }
        return $strtosend;
    }

    // Get Stock //
    public function getstock(Request $request){
        echo Inventory::where([
            'product_id' => $request->product_id,
            'color_id' => $request->color_id,
            'size_id' => $request->size_id,
        ])->first()->quantity;
    }

    // Add To Cart //
    public function addtocart(Request $request){
        $check =  Cart::where([
            'product_id' => $request->product_id,
            'color_id' => $request->color_id,
            'size_id' => $request->size_id,
            'user_id' => $request->user_id,
        ])->exists();
        if($check){
            Cart::where([
                'product_id' => $request->product_id,
                'color_id' => $request->color_id,
                'size_id' => $request->size_id,
                'user_id' => $request->user_id,
            ])->increment('user_stock_ammount', $request->user_stock_ammount);
        }
        else{
            Cart::insert([
                'product_id' => $request->product_id,
                'color_id' => $request->color_id,
                'size_id' => $request->size_id,
                'user_stock_ammount' => $request->user_stock_ammount,
                'user_id' => $request->user_id,
                'created_at' => Carbon::now()
            ]);
        }
        echo "Done";
    }

    // Get City //
    public function getcity(Request $request)
    {
        $strtosend = "<option value=''>-Select a City-</option>";
        $cities =  Shipping::where('country_id', $request->country_id)->get();
        foreach($cities as $city){
            $strtosend .= "<option value='$city->shipping_charge'>$city->city_name</option>";
        }
        echo $strtosend;
    }

    // Check Coupon //
    public function checkcoupon(Request $request){
        // Case Sensitive OFF
        // $check_exists =  Coupon::where('coupon_name', $request->coupon_name)->exists();
        // Case Sensitive ON
        // $check_exists = Coupon::whereRaw("BINARY `coupon_name`= ?",[$request->coupon_name])->exists();


        // Coupon Name Check //
        $check_exists = Coupon::whereRaw("BINARY `coupon_name`= ?",[$request->coupon_name])->exists();
        if($check_exists == 1){
            $coupon = Coupon::whereRaw("BINARY `coupon_name`= ?",[$request->coupon_name])->first();
            // Coupon Limit Check //
            if($coupon->coupon_limit == 0){
                return response()->json(['error' => 'This Coupon Limit is Over!']);
            }else{
                // Coupon Validity Check //
                if($coupon->coupon_validity < Carbon::today()){
                    return response()->json(['error' => 'This Coupon Validity is Over!']);
                }else{
                    // Coupon Discount Check //
                    if($coupon->coupon_type == 1){
                        $discount_amount = ($request->total_ammount / 100) * $coupon->coupon_amount;
                        return response()->json(['good' => $discount_amount]);
                    }else{
                        if($request->total_ammount < $coupon->coupon_amount){
                            return response()->json(['error' => "Discount can not be more than Total Amount, Please Shop More"]);
                        }else{
                            $discount_amount = $coupon->coupon_amount;
                            return response()->json(['good' => $discount_amount]);
                        }
                    }
                }
            }
        }else{
            return response()->json(['error' => 'This Coupon Name does not exists in our Records!']);
        }
    }

    // Checkout Redirect //
    public function checkoutredirect(Request $request){
        Session::put('s_total_ammount', $request->total_ammount);
        Session::put('s_discount_amount', $request->discount_amount);
        Session::put('s_shipping_charge', $request->shipping_charge);
        Session::put('s_grand_total', $request->grand_total);
        Session::put('s_country_id', $request->country_id);
        Session::put('s_city_name', $request->city_name);
        Session::put('s_coupon_name', $request->coupon_name);

        echo "Session Set";
    }

    // Order Invoice //
    public function orderinvoice($order_id){
        $order_details = Order_detail::where('order_summary_id', $order_id)->get();
        return view('frontend.order.invoice', compact('order_details'));

    }

    // Order Invoice Download //
    public function order_invoice_download($order_id){
        $order_details = Order_detail::where('order_summary_id', $order_id)->get();

        $pdf = PDF::loadView('frontend.order.invoice', compact('order_details'));
        return $pdf->download('invoice'.$order_id.'.pdf');

    }
}
