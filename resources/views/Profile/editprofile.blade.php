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
        <h2>Edit Profile</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}">
            @csrf

            <div class="mb-3">
                <label>Name:</label>
                <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
            </div>

            <div class="mb-3">
                <label>Email:</label>
                <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
            </div>

            <div class="mb-3">
                <label>Phone Number:</label>
                <input type="text" name="phonenumber" class="form-control" value="{{ $user->phonenumber }}" required>
            </div>

            <div class="mb-3">
                <label>IC:</label>
                <input type="text" name="ic" class="form-control" value="{{ $user->ic }}" required>
            </div>

            <div class="mb-3">
                <label>Role:</label>
                <input type="text" name="role" class="form-control" value="{{ $user->role }}" required>
            </div>

            <p>
    <strong>Password:</strong>
    <input type="password" id="password" value="{{ $user->password }}" readonly class="form-control d-inline w-auto" style="width: auto; display: inline-block;">
    <button type="button" onclick="togglePassword()" class="btn btn-sm btn-outline-secondary">
        👁️
    </button>
</p>

            <div class="mb-3">
    <label>Gender:</label>
    <select name="gender" class="form-select" required>
        <option value="" disabled>Select Gender</option>
        <option value="Male" {{ $user->gender == 'Male' ? 'selected' : '' }}>Male</option>
        <option value="Female" {{ $user->gender == 'Female' ? 'selected' : '' }}>Female</option>
    </select>
</div>

<div class="mb-3">
    <label>Citizenship:</label>
    <select name="citizenship" class="form-select" required>
        <option value="" disabled>Select Citizenship</option>
        <option value="Malaysian" {{ $user->citizenship == 'Malaysian' ? 'selected' : '' }}>Malaysian</option>
        <option value="Non-Malaysian" {{ $user->citizenship == 'Non-Malaysian' ? 'selected' : '' }}>Non-Malaysian</option>
    </select>
</div>


            @if($platinum)
                <div class="mb-3">
                    <label>Assigned CRMP:</label>
                    <input type="text" name="assignedCRMP" class="form-control" value="{{ $platinum->assignedCRMP }}">
                </div>
            @endif

            <button type="submit" class="btn btn-success">Save Changes</button>
            <a href="{{ route('profile.profile') }}" class="btn btn-secondary" style="margin-left: 10px;">Back</a>
        </form>
    </div>
</div>
@endsection
