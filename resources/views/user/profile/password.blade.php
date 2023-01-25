@extends('layouts.app')


@section('content')
    @if (session('status'))
        <div class="alert alert-{{ session('status') }} alert-dismissible fade show" role="alert">

            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <h3>Update Password</h3>
        </div>

        <div class="card-body">

            <form action="{{ route('user.password.update') }}" method="POST">

                @csrf
                @method('POST')
                <div class="form-group col-md-12 mt-4">
                    <label for="password_old">Enter Old Password</label>
                    <input type="password" class="form-control mt-2" id="password_old" placeholder="Enter Old Password"
                        name="password_old" value="" autocomplete="new-password" required>
                </div>

                <input type="hidden" name="id" value="{{ Auth::user()->id }}">

                <div class="form-group col-md-12 mt-5">
                    <label for="password_new">Enter New Password</label>
                    <input type="password" class="form-control mt-2" id="password_new" placeholder="Enter Password"
                        name="password" autocomplete="new-password" required>
                </div>
                <button type="submit" class="btn btn-primary text-white mt-4">Update Password</button>

            </form>
        </div>

    </div>
@endsection
