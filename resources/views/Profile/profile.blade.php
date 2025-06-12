<script>
    function togglePassword() {
        const input = document.getElementById('password');
        if (input.type === 'password') {
            input.type = 'text';
        } else {
            input.type = 'password';
        }
    }
</script>


@extends('layout')

@section('content')
<div class="content">
    <div class="card">
        <h2>Profile Information</h2>
        <p><strong>Username:</strong> {{ $user->username }}</p>
        <p><strong>Name:</strong> {{ $user->name }}</p>
        <p><strong>IC:</strong> {{ $user->ic }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Phone Number:</strong> {{ $user->phonenumber }}</p>
        <p><strong>Role:</strong> {{ $user->role }}</p>
<p>
    <strong>Password:</strong>
    <input type="password" id="password" value="{{ $user->password }}" readonly class="form-control d-inline w-auto" style="width: auto; display: inline-block;">
    <button type="button" onclick="togglePassword()" class="btn btn-sm btn-outline-secondary">
        👁️
    </button>
</p>
        <p><strong>Gender:</strong> {{ $user->gender }}</p>
        <p><strong>Citizenship:</strong> {{ $user->citizenship }}</p>

        @if($platinum)
            <p><strong>Assigned CRMP:</strong> {{ $platinum->assignedCRMP }}</p>
            <!-- Add other platinum fields here -->
        @endif

        <a href="{{ route('profile.edit') }}">
            <button class="btn btn-primary mt-3">Edit Profile</button>
        </a>
    </div>
</div>
@endsection
