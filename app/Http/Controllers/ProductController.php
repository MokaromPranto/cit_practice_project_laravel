<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\Product_gallery_photo;
use App\Models\Size;
use App\Models\Subcategory;
use Carbon\Carbon;
use Illuminate\Contracts\Filesystem\Cloud;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;
use Svg\Tag\Rect;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(isset($request->category_id)){
            $products = Product::where('product_category_id', $request->category_id)->latest()->get();
        }else{
            $products = Product::latest()->get();
        }
        // return $request->category_id;
        // return $request->sub_category_id;

        $categories = Category::latest()->get();
        return view('product.index', compact('products','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create',[
            'categories' => Category::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation //
        // $request->validate([
        //     'product_name' => 'required',
        //     'product_regular_price' => 'required',
        //     'product_short_description' => 'required',
        //     'product_category_id' => 'required',
        //     'product_subcategory_id' => 'required']
        //     ,[
        //         // Customised Message //
        //         'product_category_id.required' => 'Please Choose a Product Category',
        //         'product_subcategory_id.required' => 'Please Choose a Product Subcategory',
        //     ]
        // );
        // End Validation

        // Long Description Image Upload Start //
        $content = $request->product_long_description;
        $dom = new \DomDocument();
        $dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $imageFile = $dom->getElementsByTagName('img');

        foreach($imageFile as $item => $image){
            $data = $image->getAttribute('src');
            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $imgeData = base64_decode($data);
            $image_name= "/uploads/product_long_description_photos/" . time().$item.'.png';
            $path = public_path() . $image_name;
            file_put_contents($path, $imgeData);

            $image->removeAttribute('src');
            $image->setAttribute('src', $image_name);
        }
        $content = $dom->saveHTML();
        // Long Description Image Upload End //

        $slug = Str::slug($request->product_name)."_".Str::random(5);
        $sku = "pro"."-".Str::random(8);

        $product_id = Product::insertGetId([
            'product_name' => $request->product_name,
            'slug' => $slug,
            'product_regular_price' => $request->product_regular_price,
            'product_discounted_price' => $request->product_discounted_price,
            'product_short_description' => $request->product_short_description,
            'product_sku' => $sku,
            'product_category_id' => $request->product_category_id,
            'product_subcategory_id' => $request->product_subcategory_id,
            'product_weight' => $request->product_weight,
            'product_dimensions' => $request->product_dimensions,
            'product_materials' => $request->product_materials,
            'product_other_info' => $request->product_other_info,
            'product_long_description' => $content,
            'created_at' => Carbon::now()
        ]);

        // Image Upload Str //
        if($request->hasFile('product_thumbnail_photo')){
            $new_name = $product_id.".".$request->file('product_thumbnail_photo')->getClientOriginalExtension();
            Image::make($request->file('product_thumbnail_photo'))->resize(270,310)->save(base_path('public/uploads/product_thumbnail/'.$new_name));
        // Image Upload End //
            Product::find($product_id)->update([
                'product_thumbnail_photo' => $new_name
            ]);
        }
        return back()->with('success', 'New Product Added Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

    public function getsubcategory(Request $request)
    {
        foreach (Subcategory::where('category_id', $request->category_id)->get() as $subcategory) {
            echo "<option value='$subcategory->id'>$subcategory->subcategory_name</option>";
        }
    }

    public function color(Request $request)
    {
        $colors =  Color::all();
        return view('product.color', compact('colors'));
    }
    public function colorstore(Request $request)
    {
        // Validation //
        $request->validate([
            'color_name' => 'required',
        ]);
        // End Validation //
        Color::insert($request->except('_token')+[
            'created_at' => Carbon::now()
        ]);
        return back()->with('success' , 'Color Added Successfully!');
    }
    public function size(Request $request)
    {
        $sizes =  Size::all();
        return view('product.size', compact('sizes'));
    }
    public function sizestore(Request $request)
    {
        // Validation //
        $request->validate([
            'size_name' => 'required',
        ]);
        // End Validation //
        Size::insert($request->except('_token')+[
            'created_at' => Carbon::now()
        ]);
        return back()->with('success' , 'Size Added Successfully!');
    }

    public function inventory($product_id)
    {
        $product = Product::find($product_id);
        $colors =  Color::all();
        $sizes =  Size::all();
        $inventories = Inventory::where('product_id', $product_id)->get();
        return view('product.inventory', compact('colors','sizes','product','inventories'));
    }
    public function inventorystore($product_id, Request $request)
    {
        // Validation //
        $request->validate([
            'color_id' => 'required',
            'size_id' => 'required',
            'quantity' => 'required',]
            ,[
                // Customised Message //
                'color_id.required' => 'Please Choose a Color',
                'size_id.required' => 'Please Choose a Size',
            ]);
        // End Validation

        $exists_check = Inventory::where([
            'product_id' => $product_id,
            'color_id' => $request->color_id,
            'size_id' => $request->size_id,
        ])->exists();

        if($exists_check ==1){
            Inventory::where([
                'product_id' => $product_id,
                'color_id' => $request->color_id,
                'size_id' => $request->size_id,
            ])->increment('quantity', $request->quantity);
        }
        else{
            Inventory::insert($request->except('_token')+[
                'product_id' => $product_id,
                'created_at' => Carbon::now()
            ]);
        }
        return back()->with('success' , 'Products Successfully Added to Inventory!');
    }
    public function addgallery(Product $product_id)
    {
        return view('product.addgallery', compact('product_id'));
    }
    public function addgallerystore(Request $request, $product_id)
    {
        foreach($request->gallery_photo as $gallery_photo){
        // Image Upload Str //
            $new_name = Str::random(15).".".$gallery_photo->getClientOriginalExtension();
            Image::make($gallery_photo)->resize(270,310)->save(base_path('public/uploads/product_gallery_photo/'.$new_name));
        // Image Upload End //
            Product_gallery_photo::insert([
                'product_id' => $product_id,
                'product_gallery_photo_name' => $new_name,
                'created_at' => Carbon::now(),
            ]);
        }
        return back()->with('success' , 'Product Gallery Images Uploaded Successfully!');

    }
}
