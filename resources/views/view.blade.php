@extends('layouts.app')

<style type="text/css">
    .avatar{
        width: 200px;
        height: 200px;
        position: relative;
        overflow: hidden;
        border-radius: 50%;
      

    }

    .postimage{
        width: 730px;
        height: 400px;
        position: relative;
        overflow: hidden;

    }

</style>

@section('content')
<div class="row justify-content-center" >
<div class="col-md-10" style="text-align-last: center;" >
<h3 style="text-align-last: center; color:gray">View Post</h3>

@if(session('response'))
            <div class="alert alert-success"> {{session('response')}} </div>
        @endif
</div>
</div>


<div class="container">
    <div class="row">
    <div class="col-md-3" style="padding-top: 23px;">
                <h3 style="text-align-last: center;">Categories</h3>
                <br>
                <ul class="list-group" style="text-align-last: center; font-size: 20px;">
                    @if(count($categories)>0)
                        @foreach($categories->all() as $category)
                            <li class="list-group-item">
                                <a href=" {{ url("category/{$category->id}")}} "> {{ $category->category }} </a> 

                            </li>
                        @endforeach
                    @else
                        <h4 style="text-align-last: center; color:red; font-weight:bold;">  No Category Founded </h4>
                    @endif
                </ul>
            </div>
            <div class="col-md-1">

            </div>

            <div class="col-md-8" style="float: right;">
            @if(count($posts)>0)
                @foreach($posts->all() as $post)
                <br>
                    <h4 style="color:indigo; font-weight:bold; "> {{ $post->post_title}} </h4>
                    <cite style="float: left;">Posted On: {{ date('M j, Y H:i', strtotime($post->updated_at))}}</cite>
</hr>
                    <img src= "{{ asset( $post->post_image )}}" alt="" class="postimage">
                    <br>
                    <p style="text-align:justify;"> {{ substr($post->post_body, 0, 10000) }} </p>
                        <ul class="nav nav-pills">
                            <li role="presentation" class="btn btn-light">
                                <a href=" {{ url("/like/{$post->id}") }} ">
                                <i class="fas fa-thumbs-up" aria-hidden="true">Like ({{$likeCtr}})</i>
                                </a>
                            </li>
                            <li role="presentation" class="btn btn-light">
                                <a href=" {{ url("/dislike/{$post->id}") }} ">
                                <i class="fas fa-thumbs-down" aria-hidden="true">Dislike ({{$dislikeCtr}})</i>
                                
                                </a>
                            </li>
                            <li role="presentation" class="btn btn-light">
                                <a href=" " onclick="return alert('Please Write a Comment in Comment Box')">
                                <i class="fas fa-comment" aria-hidden="true">Comment</i>
                                </a>
                            </li>
                        </ul>
                        <br>
                    @endforeach     
                @else
                <h4 style="text-align-last: center; color:red; font-weight:bold;">  No Post Available </h4>
                @endif

                <form method="POST" action="{{ url("/comment/{$post->id}")}}">
                @csrf
                    <div class="form-group">
                        <textarea id="comment" rows="5" class="form-control" name="comment" required autofocus> </textarea>
                    </div>

                    <div class = "form-group">
                        <button type="submit" class="btn btn-success btn-lg btn-block">POST COMMENT </button>
                    </div>
                </form>
                <h3>Comments</h3>
                @if(count($comments)>0)
                    @foreach($comments->all() as $comment)
                        <p>{{ $comment->comment }}</p>
                        <p>Posted By: {{ $comment->name}}</p>
                        <hr/>
                    @endforeach

                @else
                <h4 style="text-align-last: center; color:red; font-weight:bold;">  No Comments </h4>
                @endif
            </div>
    </div>
</div>
@endsection
