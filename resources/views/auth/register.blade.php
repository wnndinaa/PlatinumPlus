@extends('layouts.auth')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <h2 class="mb-4 text-center">Register for Platinum Plus</h2>

        <form method="POST" action="{{ route('register.submit') }}">
            @csrf

            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="ic" class="form-label">IC Number</label>
                <input type="text" name="ic" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="phonenumber" class="form-label">Phone Number</label>
                <input type="text" name="phonenumber" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select name="role" class="form-select" required>
                    <option value="" disabled selected>-- Select Role --</option>
                    <option value="Platinum">Platinum</option>
                    <option value="CRMP">CRMP</option>
                    <option value="Staff">Staff</option>
                    <option value="Mentor">Mentor</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary w-100">Register</button>
        </form>

        <p class="mt-3 text-center">
            Already have an account? <a href="{{ route('login') }}">Login here</a>
        </p>
    </div>
</div>
@endsection
