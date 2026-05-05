@extends('layouts.auth')
@section('title', 'Login')
@section('content')
    <div class="row justify-content-center">
        <div class="col-lg">

            <div class="p-5">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show small shadow-sm">
                        <i class="fas fa-check-circle mr-1"></i>
                        {{ session('success') }}

                        <button type="button" class="close p-1" data-dismiss="alert">
                            <span>&times;</span>
                        </button>
                    </div>
                @endif
                @if ($errors->has('login'))
                    <div class="alert alert-danger alert-dismissible fade show small shadow-sm">
                        <i class="fas fa-exclamation-circle mr-1"></i>
                        {{ $errors->first('login') }}

                        <button type="button" class="close p-1" data-dismiss="alert">
                            <span>&times;</span>
                        </button>
                    </div>
                @endif
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                </div>

                <form method="POST" action="{{ route('login.process') }}" class="user">
                    @csrf
                    <div class="form-group">
                        <input type="email" name="email" class="form-control form-control-user"
                            placeholder="Enter Email Address..." value="{{ old('email') }}" required>
                    </div>

                    <div class="form-group">
                        <input type="password" name="password" class="form-control form-control-user" placeholder="Password"
                            required>
                    </div>

                    <button type="submit" class="btn btn-primary btn-user btn-block">
                        Login
                    </button>
                </form>

            </div>

        </div>
    </div>
@endsection
