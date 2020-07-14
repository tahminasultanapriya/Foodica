@extends('layout.app')

@section('content')

<form action="{{ route('update_blog_path', ['id' => $blogs->id]) }}" method="POST">
@csrf  
@method('PUT')

<div class="form-group"> 
    <label for="title"> Title </label>
    <input type="text" name="title" class="form-control" value="{{ $blogs->title }}">
</div>

<div class="form-group"> 
    <label for="content"> Content </label>
    <textarea name="content" rows="10" class="form-control" value="{{ $blogs->content }}">
    </textarea>
</div>

<div class="form-group">
    <button type="submit" class="btn btn-outline-primary">Edit Blog Post</button>
</div>

</form>

@endsection