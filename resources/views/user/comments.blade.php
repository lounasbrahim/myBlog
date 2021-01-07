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
                        @foreach( Auth::user()->comments as $comment)
                        <tr>
                            <td>{{ $comment->id }}</td>
                            <td class="text-nowrap"><a href="{{ route("singlePost" , $comment->post->id ) }}">{{ $comment->post->title }}</a></td>
                            <td>{{ $comment->content }}</td>
                            <td>{{ \Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}</td>
                            <td>
                                <form  id="del-comment-{{$comment->id}}" action="{{ route('deleteComment' , $comment->id)}}"  method="POST">
                                    @csrf
                                </form>
                                <button class="btn btn-danger" onclick="document.getElementById('del-comment-{{ $comment->id }}').submit()">X</> </button>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
