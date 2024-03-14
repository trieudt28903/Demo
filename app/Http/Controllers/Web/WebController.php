<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Contact;
use App\Models\Post;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class WebController extends Controller
{

    function home()
    {
        $highlight=Post::where('highlight_post',1)->take(3)->get();
        $new=Post::where('new_post',1)->take(10)->get();
        return view('web.home',compact('highlight','new'));
    }
    function post($slug)
    {
        $post = Post::where('slug', $slug)->first();

        // Increment view_counts
        $post->update([
            'view_counts' => $post->view_counts+1
        ]);

        $relate = Post::where('category_id', $post->category_id)->take(2)->inRandomOrder()->get();

        $comment=Comment::where('post_id',$post->id)->paginate(10);

        return view('web.post', compact('post', 'relate','comment'));
    }
    function comment(Request $request,$id)
    {
        Comment::create([
            'content' =>$request->get('content'),
            'user_id'=>Auth::id(),
            'post_id'=>$id,
        ]);
        return redirect()->back();
    }
    function category()
    {
        $posts=Post::paginate(10);

        return view('web.category',compact('posts'));
    }
    function categorySlug($slug)
    {
        $category=Category::where('slug',$slug)->first();
        $posts=Post::where('category_id',$category->id)->get();
        return view('web.category',compact('posts','category'));
    }
    function contact()
    {
        return view('web.contact');
    }
    function sendContact(Request $request)
    {

        Contact::create([
            'name'=>$request->name,
            'address'=>$request->address,
            'phone'=>$request->phone,
            'subject'=>$request->subject,
            'message'=>$request->message,
        ]);
        return redirect()->route('web.contact')->with('success','Gui thanh cong');
    }
}
