<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $deleted_posts = Post::onlyTrashed()->get();
        $posts = Post::all();
        return view('post.index', compact('posts', 'deleted_posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
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
        $request->validate([
            'post_title' => 'required',
            'post_des' => 'required']
            ,[
                'post_des.required' => 'Please add a Description of this Post!',

        ]);
        // End Validation //

        $post_id = Post::insertGetId($request->except('_token')+[
            'post_title' => $request->post_title,
            'post_des' => $request->post_des,
            'created_at' => Carbon::now()
        ]);
        // Image Upload Str //
        if($request->hasFile('post_image')){
            $new_name = $post_id.".".$request->file('post_image')->getClientOriginalExtension();
            Image::make($request->file('post_image'))->resize(370,250)->save(base_path('public/uploads/post_img/'.$new_name));
        // Image Upload End //
            Post::find($post_id)->update([
                'post_image' => $new_name
            ]);
        }
        return back()->with('success', 'New Post Added Successfully!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return back()->with('soft_delete_msg', 'Post Moved to Recycle Bin!');
    }
    public function postrestore($post_id)
    {
        Post::onlyTrashed()->find($post_id)->restore();
        return back()->with('post_restore_success', 'Post Restored Successfully!');
    }
    public function postharddelete(Post $post)
    {
        $post->forceDelete();
        return back()->with('post_hard_del_msg', 'Post has been Deleted Permanently!');
    }

}
