@extends('layouts.master')
@section('title')
Registration
@endsection
@section('main-content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Registration Form</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('create_user') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required placeholder="Enter Name">
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required placeholder="Enter Username">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" required placeholder="Enter Email"> 
                            
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid state-invalid @enderror" id="password" name="password" required>
                            @if($errors->has('password'))
                                <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                            @endif

                        </div>
                        <div class="mb-3">
                            <label for="retype_password" class="form-label">Retype Password</label>
                            <input type="password" class="form-control @error('retype_password') is-invalid state-invalid @enderror" id="retype_password" name="retype_password" required>
                            @if($errors->has('retype_password'))
                                <div class="invalid-feedback">{{ $errors->first('retype_password') }}</div>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary">Register User</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection