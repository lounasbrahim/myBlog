@extends("layouts.admin")
@section("title") Editing User:  {{ $user->name }} @endsection
@section("content")
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-light">
                            Basic Forms
                        </div>
                        @if (session("success"))
                            <div class="alert alert-success">{{session("success")}}</div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach( $errors->all() as $error)
                                        <li> {{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action=" {{ route("updateUser" , $user->id) }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="normal-input" class="form-control-label" >name</label>
                                            <input name="name" id="normal-input" class="form-control" value="{{$user->name}}">
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="normal-input" class="form-control-label">email</label>
                                            <input name="email" id="normal-input" class="form-control" value="{{$user->email}}">
                                        </div>
                                    </div>

                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="normal-input" class="form-control-label">Permissions</label>
                                            <label for="author">author
                                            <input type="checkbox"  id="author" name="author" {{ $user->author == true ? "checked" : "" }}></label>
                                            <label for="admin">admin
                                            <input type="checkbox" id="admin" name="admin" {{ $user->admin == true ? "checked" : "" }}></label>
                                        </div>
                                    </div>


                                </div>
                                <button class="btn btn-primary"  type="submit">Edit User</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
