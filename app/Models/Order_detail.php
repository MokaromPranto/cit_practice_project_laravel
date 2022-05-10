<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Order_detail extends Model
{
    use HasFactory, SoftDeletes;


    public function relationwithproduct(){
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
    public function relationwithcolor(){
        return $this->hasOne(Color::class, 'id', 'color_id');
    }
    public function relationwithsize(){
        return $this->hasOne(Size::class, 'id', 'size_id');
    }
    public function relationwithordersummary(){
        return $this->hasOne(Order_summary::class, 'id', 'order_summary_id');
    }
}
