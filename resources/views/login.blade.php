@extends('layouts.template')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-md-6">
            <div class="card p-4 shadow">
                <div class="text-center mb-4">
                    <img src="{{ asset('uploads/login.jpeg') }}" alt="Your Logo" class="img-fluid" style="max-width: 100px;">
                </div>
                @if (Session::get('failed'))
                    <div class="alert alert-danger">{{ Session::get('failed') }}</div>
                @endif
                <form action="{{ route('login.auth') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="username" class="form-label">username:</label>
                        <input type="username" class="form-control" id="username" name="username" value="{{ old('username') }}" required>
                        @error('username')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}" required>
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
