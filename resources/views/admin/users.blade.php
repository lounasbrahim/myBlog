@extends("layouts.admin")
@section("title") Admin Comments @endsection
@section("content")
    <div class="content">
        <div class="card">
            <div class="card-header bg-light">
                Admin comments
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Posts</th>
                            <th>Comments</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach( $users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->posts->count() }}</td>
                                <td>{{ $user->comments->count() }}</td>
                                <td>{{ \Carbon\Carbon::parse($user->created_at)->diffForHumans()  }}</td>
                                <td>{{ \Carbon\Carbon::parse($user->updated_at)->diffForHumans()  }}</td>

                                <td>
                                    <form style="display:none;" id="del-user-{{$user->id}}" action="{{ route('deleteUser' , $user->id)}}"  method="POST">
                                        @csrf
                                    </form>
                                    <a href="{{ route("editUser" , $user->id) }}"><button class="btn btn-primary"><i class="icon icon-pencil"></i></button></a>
                                    <button class="btn btn-danger" data-toggle="modal" data-target="#deletePostModal-{{ $user->id }}">X</> </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @foreach($users as $user)
        <div class="modal fade" id="deletePostModal-{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">You are about to delete : <strong>{{ $user->name }} </strong></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No, keep it.</button>
                        <form  id="del-user-{{$user->id}}" action="{{ route('deleteUser' , $user->id)}}"  method="POST">
                            <button type="button" class="btn btn-primary" onclick="document.getElementById('del-user-{{$user->id}}').submit()">Yes, delete it.</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach


@endsection
