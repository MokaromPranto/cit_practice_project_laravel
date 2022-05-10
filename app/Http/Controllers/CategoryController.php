<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Image;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkrole');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('category.index',[
            'categories' => Category::all(),
            'deleted_categories' => Category::onlyTrashed()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     */
    public function store(Request $request)
    {
        // Validation //
        $request->validate([
            'category_name' => 'required',
        ]);
        // End Validation //

        $category_id = Category::insertGetId([
            'category_name' => $request->category_name,
            'slug' => Str::slug($request->category_name),
            'created_at' => Carbon::now(),
        ]);

        // Image Upload Str //
        if($request->hasFile('category_photo')){
            $new_name = $category_id.".".$request->file('category_photo')->getClientOriginalExtension();
            Image::make($request->file('category_photo'))->resize(600,328)->save(base_path('public/uploads/category/'.$new_name));
        // Image Upload End //
            Category::find($category_id)->update([
                'category_photo' => $new_name
            ]);
        }
        return back()->with('success', 'Category Added Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {

        return view('category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $new_cat_name = $request->category_name;
        $old_cat_name = $category->category_name;
        // OPTION 1 //
        // $category->update([
        //     'category_name' => $request->category_name
        // ]);
        // return redirect('category');

        // OPTION 2 //
        $category->category_name = $request->category_name;
        $category->save();

        if($request->hasFile('category_photo')){
            echo "1";
            // // Old IMG Delete From All Location /// ///
            if($category->category_photo != 'default_category_photo.jpg'){
                $this_path = public_path()."/uploads/category/".$category->category_photo;
                unlink($this_path);
            }

            // New Image Upload //
            $new_name = $category->id.".".$request->file('category_photo')->getClientOriginalExtension();
            Image::make($request->file('category_photo'))->resize(300,150)->save(base_path('public/uploads/category/'.$new_name));

            Category::find($category->id)->update([
                'category_photo' => $new_name
            ]);
        }

        return redirect('category')->with('update_msg', $old_cat_name.' Category Updated Successfully to '.$new_cat_name.'!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        // Detete Products //
        Product::where('product_category_id', $category->id)->delete();
        // Detete Subcategories //
        Subcategory::where('category_id', $category->id)->delete();
        // Detete Categories //
        $category->delete();
        return redirect('category')->with('soft_delete_msg', 'Category Removed From List!');
    }
    public function categoryrestore($category_id)
    {
        // Restore Product
        Product::onlyTrashed()->where('product_category_id', $category_id)->restore();
        // Restore Subcategory
        Subcategory::onlyTrashed()->where('category_id', $category_id)->restore();
        // Restore Category
        Category::onlyTrashed()->find($category_id)->restore();
        return back()->with('cat_restore_success', 'Category Restored Successfully!');
    }

    // public function harddelete(Category $category)
    // {
    //     // // Old IMG Delete From All /// ///
    //     if($category->category_photo != 'default_category_photo.jpg'){
    //         $this_path =public_path()."/uploads/category/".$category->category_photo;
    //         unlink($this_path);
    //     }
    //     $category->forceDelete();
    //     return back()->with('hard_delete_msg', 'Category Deleted Successfully!');
    // }
}
