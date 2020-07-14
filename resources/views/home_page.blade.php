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
                    
                    <h4 style="text-align: left; color:indigo; font-weight:bold; "> {{ $post->post_title}} </h4> 
                    <cite style="float: left;">Posted On: {{ date('M j, Y H:i', strtotime($post->updated_at))}}</cite>
</hr>   
                      
                    <img src= "{{ asset( $post->post_image )}}" alt="" class="postimage">
                    
                    <p style="text-align:justify"> {{ substr($post->post_body, 0, 10000) }} </p>

                    <ul class="nav nav-pills">
                            <li role="presentation" class="btn btn-light">
                                <a href=" {{ url("/home_view/{$post->id}") }} ">
                                <i class="fas fa-eye" aria-hidden="true">VIEW</i>
                                </a>
                            </li>
                    </ul>
 
                    @endforeach     
                @else
                <h4 style="text-align-last: center; color:red; font-weight:bold;">  No Post Available </h4>
                @endif
                {{ $posts->links() }}

            </div>
    </div>
</div>
@endsection
