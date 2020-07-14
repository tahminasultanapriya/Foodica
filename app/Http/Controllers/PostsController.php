<?php

namespace App\Http\Controllers;

use App\Category;
use App\Comment;
use App\Dislike;
use App\Http\Controllers\Controller;
use App\Like;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Symfony\Component\Console\Input\Input;
use Illuminate\Http\Request;
use App\Post;
use App\Profile;
use Illuminate\Support\Facades\Auth as FacadesAuth;

use function Ramsey\Uuid\v1;

class PostsController extends Controller
{
    public function show()
    {
        $categories = Category::all();
        return view('post', ['categories' => $categories]);

    }

    public function addPost(Request $request)
    {
        
        $posts = new Post;
        $posts ->post_body= $request->input('post_body');
        $posts ->post_title= $request->input('post_title');
        $posts->category_id = $request->input('category_id');
        $path = Storage::putFile('public', $request->file('post_image'));
        $url = Storage::url($path);
        $posts ->post_image = $url;
        $posts ->save();
        return redirect('/home')->with('response', 'Post Created Successfully');

    }
    public function addPost1(Request $request)
    {
        
        $posts = Post::paginate(3);
        $categories = Category::all();
        return view('home_page', ['posts' => $posts, 'categories'=> $categories]);

    }
    public function view($post_id)
    {
        $posts = Post::where('id', '=', $post_id)->get();
        $categories = Category::all();
        $likePost = Post::find($post_id);
        $likeCtr = Like::where(['post_id' => $likePost->id])->count();
        $dislikeCtr = Dislike::where(['post_id' => $likePost->id])->count();
        $comments = DB::table('users')->join('comments', 'users.id', '=', 'comments.user_id')->join('posts','comments.post_id', '=', 'posts.id')->select('users.name', 'comments.*')->where(['posts.id' => $post_id])->get();
        return view('view', ['posts' => $posts, 'categories'=> $categories, 'likeCtr' => $likeCtr, 'dislikeCtr' => $dislikeCtr, 'comments' => $comments]);
    }

    public function home_view($post_id)
    {
        $posts = Post::where('id', '=', $post_id)->get();
        $categories = Category::all();
        $likePost = Post::find($post_id);
        $likeCtr = Like::where(['post_id' => $likePost->id])->count();
        $dislikeCtr = Dislike::where(['post_id' => $likePost->id])->count();
        $comments = DB::table('users')->join('comments', 'users.id', '=', 'comments.user_id')->join('posts','comments.post_id', '=', 'posts.id')->select('users.name', 'comments.*')->where(['posts.id' => $post_id])->get();
        return view('home_view', ['posts' => $posts, 'categories'=> $categories, 'likeCtr' => $likeCtr, 'dislikeCtr' => $dislikeCtr, 'comments' => $comments]);
    }

    public function edit($post_id)
    {
        $posts = Post::find($post_id);
        $categories = Category::all();
        $category = Category::find($posts->category_id);
        return view('edit', ['posts' => $posts, 'categories'=> $categories, 'category' => $category]);
    }

    public function editPost(Request $request, $post_id)
    {
        $posts = new Post;
        $posts ->post_body= $request->input('post_body');
        $posts ->post_title= $request->input('post_title');
        $posts->category_id = $request->input('category_id');
        $path = Storage::putFile('public', $request->file('post_image'));
        $url = Storage::url($path);
        $posts ->post_image = $url;
        $data = array(
            'post_title' => $posts->post_title,
            'post_body' => $posts->post_body,
            'category_id' => $posts->category_id,
            'post_image' => $posts->post_image,

        );
        Post::where('id', $post_id)->
        update($data);
        $posts ->update();
        return redirect('/home')->with('response', 'Post Updated Successfully');


    }

    public function deletePost($post_id)
    {
        Post::where('id', $post_id)->
        delete();
        return redirect('/home')->with('response', 'Post Deleted');
        

    }

    public function category($cat_id)
    {
        $categories = Category::all();
        $posts = DB::table('posts')->join('categories', 'posts.category_id', '=', 'categories.id')->select('posts.*', 'categories.*')->where(['categories.id' => $cat_id])->get();
        return view('Categories.categoriespost', ['categories' => $categories, 'posts' => $posts]);

    }
    public function like($id)
    {
        $loggedin_user = Auth::user()->id;
        $like_user = Like::where(['user_id' => $loggedin_user, 'post_id' => $id])->first();
        if(empty($like_user->user_id))
        {
            $user_id = Auth::user()->id;
            $email = Auth::user()->email;
            $post_id = $id;
            $like = new Like;
            $like->user_id = $user_id;
            $like->email = $email;
            $like->post_id = $post_id;
            $like->save();
            return redirect("/view/{$id}");

        }
        else{
            return redirect("/view/{$id}");
        }
    }

    public function dislike($id)
    {
        $loggedin_user = Auth::user()->id;
        $dislike_user = Dislike::where(['user_id' => $loggedin_user, 'post_id' => $id])->first();
        if(empty($dislike_user->user_id))
        {
            $user_id = Auth::user()->id;
            $email = Auth::user()->email;
            $post_id = $id;
            $dislike = new Dislike;
            $dislike->user_id = $user_id;
            $dislike->email = $email;
            $dislike->post_id = $post_id;
            $dislike->save();
            return redirect("/view/{$id}");

        }
        else{
            return redirect("/view/{$id}");
        }
    }

    public function comment(Request $request, $post_id)
    {
        $comment = new Comment;
        $comment->comment = $request->input('comment');
        $comment->user_id = Auth::user()->id;
        $comment->post_id= $post_id;
        $comment->save();
        return redirect("/view/{$post_id}")->with('response', 'Comment Added Successfully');

    }

    public function search(Request $request)
    {
        $user_id = Auth::user()->id;
        $profile = DB::table('users')
                        ->join('profiles', 'users.id', '=', 'profiles.user_id')
                        ->select('users.*', 'profiles.*')
                        ->where(['profiles.user_id' => $user_id])
                        ->first();
        $posts = Post::paginate(2);
        $keyword = $request->input('search');
        $posts = Post::where('post_title', 'LIKE', '%'.$keyword.'%')->get();
        return view('searchposts', ['profile' => $profile, 'posts' => $posts]);

    }

 
}
