<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use \Illuminate\Support\Str;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    function index()
    {
        $category=Category::all();
        return view('admin.category.list',compact('category'));
    }
    function create()
    {

        return view('admin.category.create');
    }
    public function store(Request $request)
    {
        $this->validate($request,
                [
                    'name'=>'required'
                ],
                [
                    'name.required'=>'Vui lòng nhập tên Category'
                ],
        );
        do {
            $slug = Str::slug($request->name);
            $checkSlug = Category::where('slug', $slug)->first();

            if ($checkSlug) {
                $slug = $slug . '-' . Str::random(2);
            }
        } while ($checkSlug);

        Category::create([
            'name' => $request->name,
            'slug' => $slug,
        ]);

        return redirect()->route('admin.category.index')->with('success', 'Category created successfully');
    }
    function edit($id)
    {
        $category=Category::find($id);
        return view('admin.category.edit',compact('category'));
    }
    function update($id,Request $request)
    {

        $this->validate($request,
            [
                'name'=>'required'
            ],
            [
                'name.required'=>'Vui lòng nhập tên Category'
            ],
        );
        do {
            $slug = Str::slug($request->name);
            $checkSlug = Category::where('slug', $slug)->first();

            if ($checkSlug) {
                $slug = $slug . '-' . Str::random(2);
            }
        } while ($checkSlug);
        $category=Category::find($id);
        $category->update([
            'name' => $request->name,
            'slug' => $slug,
        ]);

        return redirect()->route('admin.category.edit',$id)->with('success', 'Category created successfully');
    }
    function delete($id)
    {
        $category=Category::find($id);
        $category->delete();
        return redirect()->route('admin.category.index')->with('success', 'Deleted Successfully');
    }
}
