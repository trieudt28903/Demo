<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    //
    function index()
    {
        $posts=Post::paginate(20);
        return view('admin.post.list',compact('posts'));
    }
    function create()
    {
        $categories=Category::all();
        return view('admin.post.create',compact('categories'));
    }
    public function store(Request $request)
    {

        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'content' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg',
            'category_id' => 'required',
        ]);

        $slug = Str::slug($request->title);
        $checkSlug = Post::where('slug', $slug)->first();

        if ($checkSlug) {
            $slug = $slug . '-' . Str::random(2);
        }

        $image = null;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name_file = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();

            $image = Str::random(5) . "_" . $name_file;

            while (file_exists("image/post/" . $image)) {
                $image = Str::random(5) . "_" . $name_file;
            }

            $file->move('image/post', $image);
        }
        Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->get('content'),
            'image' => $image,
            'view_counts' => 0,
            'new_post' => $request->new_post?1:0,
            'slug' => $slug,
            'user_id' => 3,
            'category_id' => $request->category_id,
            'highlight_post' => $request->highlight_post?1:0,
        ]);

        return redirect()->route('admin.post.index')->with('success', 'Post created successfully');
    }
    function edit($id)
    {
        $categories=Category::all();
        $post=Post::find($id);
        return view('admin.post.edit',compact(['categories','post']));
    }
    function update($id,Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'content' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg',
            'category_id' => 'required',
        ]);

        $slug = Str::slug($request->title);
        $checkSlug = Post::where('slug', $slug)->first();

        if ($checkSlug) {
            $slug = $slug . '-' . Str::random(2);
        }

        $image = null;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name_file = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();

            $image = Str::random(5) . "_" . $name_file;

            while (file_exists("image/post/" . $image)) {
                $image = Str::random(5) . "_" . $name_file;
            }

            $file->move('image/post', $image);
        }
        $post=Post::find($id);
        $post->update([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->get('content'),
            'image' => $image,
            'view_counts' => 0,
            'new_post' => $request->new_post?1:0,
            'slug' => $slug,
            'user_id' => 3,
            'category_id' => $request->category_id,
            'highlight_post' => $request->highlight_post?1:0,
        ]);

        return redirect()->route('admin.post.index')->with('success', 'Post Update successfully');
    }
    function delete($id)
    {
        $post=Post::find($id);
        $post->delete();
        return redirect()->route('admin.post.index')->with('success', 'Post Delete successfully');
    }
}
