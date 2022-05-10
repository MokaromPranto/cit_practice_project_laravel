<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->string('slug');
            $table->integer('product_regular_price');
            $table->integer('product_discounted_price')->nullable();
            $table->text('product_short_description');
            $table->string('product_sku');
            $table->string('product_category_id');
            $table->string('product_subcategory_id');
            $table->string('product_weight')->nullable();
            $table->string('product_dimensions')->nullable();
            $table->string('product_materials')->nullable();
            $table->longText('product_other_info')->nullable();
            $table->longText('product_long_description')->nullable();
            $table->string('product_thumbnail_photo')->default('default_product_thumbnail_photo.jpg');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
