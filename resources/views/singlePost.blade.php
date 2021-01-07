@extends('layouts.master')
@section('content')

<!-- Page Header -->
<header class="masthead" style="background-image: url('{{asset("/assets/img/post-bg.jpg")}}')">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="post-heading">
                    <h1>{{$post->title}}</h1>
                    <span class="meta">Posted by
              <a href="#">{{$post->user->name}}</a>
              on  {{ date_format($post->created_at , "F d, Y") }} </span>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Post Content -->
<article>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                {!! nl2br($post->content) !!}
            </div>
        </div>
        <div style="margin-top: 50px"">
            <hr>
            <h2>Comments</h2>
             @foreach($post->comments as $comment)
            <div class="clearfix" style="margin-top:20px; background: #f5f5f5;padding: 1em">
                <h6>{{$comment->user->name }}</h6>
                <div class="row">
                <p class="col-8" style="">{{$comment->content}}</p>
                <p class="col-4" style="text-align: end"><small>{{ date_format($comment->created_at , 'F d,Y')}}</small></p>
                </div>
            </div>
            @endforeach
            @if(\Illuminate\Support\Facades\Auth::check())
                <form action="{{ route("newComment") }}" method="POST">
                    @csrf
                    <div style="margin-top: 20px " class="form-group">
                        <textarea class="form-control" name="comment" id="comment" cols="4" rows="3"></textarea>
                        <input type="hidden" name="post"  value="{{ $post->id }}">
                    </div>
                    <div class="form-group">
                       <button  class="btn btn-primary" type="submit">Make Comment</button>
                    </div>
                </form>
            @endif
            @if(\Illuminate\Support\Facades\Auth::check() == false)
                    <div style="margin-top: 20px " class="alert alert-warning" role="alert">
                        You should login to comment !
                    </div>
            @endif
        </div>
    </div>
</article>

<hr>

@endsection
