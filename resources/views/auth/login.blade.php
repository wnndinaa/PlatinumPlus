@extends('layouts.auth')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <h2 class="mb-4 text-center">Login to Platinum Plus</h2>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('login.process') }}">
            @csrf

            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input
                    type="text"
                    name="username"
                    id="username"
                    class="form-control @error('username') is-invalid @enderror"
                    value="{{ old('username') }}"
                    required
                    autofocus>
                @error('username')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input
                    type="password"
                    name="password"
                    id="password"
                    class="form-control @error('password') is-invalid @enderror"
                    required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>

        <p class="mt-3 text-center">
            New to Platinum Plus?
            <a href="{{ route('register') }}">Create account now</a>
        </p>
    </div>
</div>
@endsection
