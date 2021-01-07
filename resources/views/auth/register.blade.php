@extends("layouts.auth")
@section("title") Register
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card p-4">
                    <div class="card-header text-center text-uppercase h4 font-weight-light">
                        Register
                    </div>

                    <form method="POST" action="{{ route("register") }}">
                        @csrf
                        <div class="card-body py-5">
                            <div class="form-group">
                                <label class="form-control-label">Name</label>
                                <input type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            </div>

                            <div class="form-group">
                                <label class="form-control-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                            </div>

                            <div class="form-group">
                                <label class="form-control-label">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            </div>

                            <div class="form-group">
                                <label class="form-control-label">Confirm Password</label>
                                <input type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                            <span class="alter">Already have an account ? <a href="/login">Login</a></span>
                        </div>



                        <div class="card-footer" style="margin-top: -50px">
                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection
