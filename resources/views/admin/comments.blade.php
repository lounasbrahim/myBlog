@extends("layouts.admin")
@section("title") User Comments @endsection
@section("content")
    <div class="content">
        <div class="card">
            <div class="card-header bg-light">
                User comments
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Posts</th>
                            <th>Content</th>
                            <th>Created at</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach( $comments as $comment)
                            <tr>
                                <td>{{ $comment->id }}</td>
                                <td class="text-nowrap"><a href="{{ route("singlePost" , $comment->post->id ) }}">{{ $comment->post->title }}</a></td>
                                <td>{{ $comment->content }}</td>
                                <td>{{ \Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}</td>
                                <td>
                                    <form  id="del-comment-{{$comment->id}}" action="{{ route('adminDeleteComment' , $comment->id)}}"  method="POST">
                                        @csrf
                                    </form>
                                    <button class="btn btn-danger" data-toggle="modal" data-target="#deletePostModal-{{ $comment->id }}">X</> </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @foreach($comments as $comment)
        <div class="modal fade" id="deletePostModal-{{ $comment->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">You are about to delete this comment !</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No, keep it.</button>
                        <form  id="del-comment-{{$comment->id}}" action="{{ route('adminDeleteComment' , $comment->id)}}"  method="POST">
                            <button type="button" class="btn btn-primary" onclick="document.getElementById('del-comment-{{$comment->id}}').submit()">Yes, delete it.</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

@endsection
