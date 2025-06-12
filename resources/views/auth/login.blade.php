@extends('layouts.auth')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <h2 class="mb-4 text-center">Login to Platinum Plus</h2>

        <form method="POST" action="{{ route('login.process') }}">
            @csrf

            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" id="username" class="form-control" required autofocus>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select name="role" id="role" class="form-select" required>
                    <option value="" disabled selected>-- Select Role --</option>
                    <option value="Platinum">Platinum</option>
                    <option value="CRMP">CRMP</option>
                    <option value="Mentor">Mentor</option>
                    <option value="Staff">Staff</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>

        <p class="mt-3 text-center">
            Don't have an account? <a href="{{ route('register') }}">Register here</a>
        </p>
    </div>
</div>
@endsection
