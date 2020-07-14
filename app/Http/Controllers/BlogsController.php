<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Blog;
use Illuminate\Support\Facades\Storage;

class BlogsController extends Controller
{
    public function index()
    {
        $blogs =Blog::all();
        return view('blog.index', ['blogs' => $blogs]);
    }
    public function show($id)
    {
        $blog = Blog::find($id);
        return view('blog.show', ['blogs' => $blog]);
    }

    public function edit($id)
    {
        $blog = Blog::find($id);
        return view('blog.edit', ['blogs' => $blog]);
    }

    public function create()
    {
        return view('blog.create');
    }

    public function update(Request $request, $id)
    {
        $blog = Blog::find($id);
        $blog->title = $request->title;
        $blog->content = $request->content;

        $blog->update();

        return redirect()->route('blog_path', ['id' => $blog]);
    }
    public function destroy($id)
    {
        $blog = Blog::find($id);


        $blog->delete();

        return redirect()->route('blogs_path');
    }
    public function store(Request $request)
    {
        $blog = new Blog;
        $path = Storage::putFile('public', $request->file('files'));
        $url = Storage::url($path);
        $blog->image = $url;
        $blog->title = $request->title;
        $blog->content = $request->content;
        $blog->save();
        return redirect()->route('blogs_path');
 
    }

}
