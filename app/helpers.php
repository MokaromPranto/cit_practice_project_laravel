<?php

use App\Models\Cart;
use App\Models\Inventory;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;

function available_stock($product_id, $color_id, $size_id){
    return Inventory::where([
        'product_id' => $product_id,
        'color_id' => $color_id,
        'size_id' => $size_id,
    ])->first()->quantity;
}
function total_cart_item()
{
    return Cart::where('user_id', auth()->id())->count();
}

function settings($setting_name)
{
    $settings = Setting::where('setting_name', $setting_name)->first();
    print($settings->setting_value);
}

?>
