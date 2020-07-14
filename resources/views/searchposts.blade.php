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
<div class="card" style="text-align-last: center;">
    @if(count($errors)>0)
    @foreach($errors->all() as $error)
        <div class="alert alert-danger"> {{$error}} </div>
        @endforeach
    @endif

    @if(session('response'))
        <div class="alert alert-success"> {{session('response')}} </div>
    @endif
</div>

<div class="container">
        <div class="row">
            <div class="col-md-3" style="text-align-last: center;">
                <h3 >
                Dashboard
                </h3> 
            </div>
            <div class="col-md-1">
            </div>
            <div class="col-md-8">
                <form method="POST" action="{{ url("/search") }}">
                @csrf
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-primary">
                            Go!
                        </button>
                    </span>
                </div>
            
            </form>
            </div>
        </div>
  
</div>



<div class="container">
    <div class="row">
        <div class="col-md-3" style="padding-top:65px; text-align: center;" >
            @if(!empty($profile))
                <img src= "{{ asset( $profile->profile_pic )}}" alt="" class="avatar">
            @else
            <img src= "{{ url('images/th.jfif')}}" alt="" class="avatar">
            @endif

    

            @if(!empty($profile))
            <p class="lead" style="color: red; font-weight:bold;" > {{ $profile->name }} </p>
            @else
            <p></p>
            @endif

    
            @if(!empty($profile))
            <p class="lead" style="color: black; font-weight:normal;"> {{ $profile->designation }} </p>
            @else
            <p></p>
            @endif

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
                            <a href=" {{ url("/view/{$post->id}") }} ">
                            <i class="fas fa-eye" aria-hidden="true">VIEW</i>
                            </a>
                        </li>
                        <li role="presentation" class="btn btn-light">
                            <a href=" {{ url("/edit/{$post->id}") }} ">
                            <i class="fas fa-edit" aria-hidden="true">EDIT</i>
                            
                            </a>
                        </li>
                        <li role="presentation" class="btn btn-light">
                            <a href=" {{ url("/delete/{$post->id}") }} " onclick="return confirm('Are You Sure You Want to Delete?')">
                            <i class="fas fa-trash" aria-hidden="true">DELETE</i>
                            </a>
                        </li>
                    </ul>
                    <br>


                @endforeach     
            @else
            <h4 style="text-align-last: center; color:red; font-weight:bold;">  No Post Available </h4>
            @endif
           
        </div>
    </div>
</div>
@endsection
