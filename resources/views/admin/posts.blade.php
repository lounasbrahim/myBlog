@extends("layouts.admin")

@section("title") Author Posts @endsection

@section("content")
    <div class="content">
        <div class="card">
            <div class="card-header bg-light">
                Author Posts
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                            <th>Comments</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach( $posts as $post)
                            <tr>
                                <td>{{ $post->id }}</td>
                                <td class="text-nowrap"><a href="{{ route("singlePost" , $post->id ) }}">{{ $post->title }}</a></td>
                                <td>{{ $post->user->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($post->created_at)->diffForHumans()  }}</td>
                                <td>{{ \Carbon\Carbon::parse($post->updated_at)->diffForHumans() }}</td>
                                <td>{{ count( $post->comments) }}</td>

                                <td>
                                    <form  id="del-post-{{$post->id}}" action="{{ route('adminDeletePost' , $post->id)}}"  method="POST">
                                        @csrf
                                    </form>
                                    <a href="{{ route("adminPostEditPost" , $post->id) }}"><button class="btn btn-primary" onclick=""><i class="icon icon-pencil"></i></> </button></a>
                                    <button class="btn btn-danger" data-toggle="modal" data-target="#deletePostModal-{{ $post->id }}">X</> </button>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @foreach($posts as $post)
    <div class="modal fade" id="deletePostModal-{{ $post->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">You are about to delete : <strong>{{ $post->title }}</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No, keep it.</button>
                    <form  id="del-post-{{$post->id}}" action="{{ route('adminDeletePost' , $post->id)}}"  method="POST">
                        <button type="button" class="btn btn-primary" onclick="document.getElementById('del-post-{{$post->id}}').submit()">Yes, delete it.</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach



@endsection
