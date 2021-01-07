@extends('layouts.master')
@section("content")

    <!-- Page Header -->
<header class="masthead" style="background-image: url('{{asset('assets/img/home-bg.jpg')}}')">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="site-heading">
                    <h1>My Blog</h1>
                    <span class="subheading">Blog Articles :)</span>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            @foreach($posts as $post)
                    <div class="post-preview" style="padding-bottom:1em;margin-bottom: 20px">
                        <a href="{{ route("singlePost" , $post->id) }}">
                            <h2 class="post-title">
                                {{ $post->title }}
                            </h2>
                            <h3 class="post-subtitle">
                                Lorem ipsum dolor sit amet, consectetur ?
                            </h3>
                        </a>
                        <p class="post-meta" >Posted by
                            <a href="#">{{ $post->user->name }}</a>
                            On {{ date_format($post->created_at , 'F d,Y')}}
                            <span style="margin-right:8px"></span>
                            <i class="fa fa-comment" aria-hidden="true" >{{  $post->comments->count() }}</i>
                        </p>
                        <div class="row">
                            <div class="" style="margin-left: 15px">
                                {{ \Illuminate\Support\Str::limit($post->content, 150) }}
                            </div>
                        </div>
                    </div>
            @endforeach

            <!-- Pager -->
            <div class="clearfix" style="margin-top: 30px">
                <hr>
                <div class="float-right">{{ $posts->links() }} </div>

            </div>
        </div>
    </div>
</div>

@endsection
