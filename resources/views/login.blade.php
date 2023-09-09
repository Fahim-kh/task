@extends('layouts.master')
@section('title')
Login
@endsection
@section('main-content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Login</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('post_login') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>
                        <br>
                        <a href="{{ route('registration') }}">Create User</a>
                    </form>
                    <br>
                    @if(Session::has('success'))
                        <div class="alert alert-success flash-message" role="alert">{{ Session::get('success') }}</div>
                    @elseif(Session::has('error'))
                        <div class="alert alert-danger flash-message" role="alert">{{ Session::get('error') }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
@endsection