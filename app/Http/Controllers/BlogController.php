<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Str;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if (Auth::check()) {
        //     $user = Auth::user();
            // $blogs = Blog::with('user')->orderBy('created_at','desc');
        //     ->where('user_id',$user->id)
        //     ->get();
        //     # code...
        // }else{

            $blogs = Blog::withTrashed()->get();
        // }

        return view('blog.index',compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blog.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',


        ]);
        $user = Auth::user();

        if ($validator->fails()) {
            return response()->json(['success', true, 'errors' => $validator->errors()], 422);
        }
        $imageurl= null;

        $blog = new Blog();
        if ($request->hasFile('image')) {
            $img = $request->image;
            $filename = $img->getClientOriginalName();
            $imageurl = Storage::putFileAs('/public/image', $request->file('image'), $filename);
        }
        $blog->title= $request->title;
        $blog->slug= Str::slug($request->title);
        $blog->image= $imageurl;
        $blog->description = $request->description;
        $blog->tags = $request->tags;
        $blog->user_id = $user->id;
        // dd($request->all());
        $blog->save();
        return response(['success' => true, 'message' => 'blog created successfully']);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        $blog->load(['user','comments']);

        return view('blog.show',compact('blog'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        return view('blog.edit', compact('blog'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();
        return back()->with('message','blog deleted succesfully');

    }

    public function permanentDelete($slug)
    {
        $blog = Blog::withTrashed()->where('slug', $slug)->first();
        $blog->forceDelete();
        return back()->with('message','blog deleted permanently');

    }

    public function restore($slug)
    {
        $blog = Blog::withTrashed()->where('slug', $slug)->orderBy('created_at','desc')->first();
        // dd($blog);
        $blog->restore();
        return back()->with('message','blog Restore  Succesfully');

    }
}
