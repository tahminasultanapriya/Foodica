@extends('layout.app')

@section('content')

<div class="row">
    <div class="col-md-12">
        <br>
        <img src= "{{ asset( $blogs->image )}}" alt="" class="card-img-top">
        <br><br>

        <h3>
        {{ $blogs -> title }}
        </h3>
        <br>

        <p class="lead">
        {{ $blogs -> content }}
        </p>
        <a href="{{ route('edit_blog_path', ['id'=> $blogs->id ]) }}" class="btn btn-outline-info">Edit</a>
        <a href="{{ route('blogs_path') }}" class="btn btn-outline-secondary">Back</a>

        <form action="{{ route('delete_blog_path', ['id'=> $blogs->id ]) }}" method="POST">
            @csrf
            @method('DELETE')
     
        <Button type="submit" class="btn btn-outline-danger">Delete</Button>

        </form>
    </div>

    

</div>

@endsection