<script>
    function togglePassword() {
        const input = document.getElementById('password');
        input.type = input.type === 'password' ? 'text' : 'password';
    }
</script>

@extends('layout')

@section('content')
<div class="content">
    <div class="card p-4">
        <h2 class="mb-4">Edit Profile</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}">
            @csrf

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Username:</label>
                    <input type="text" name="username" class="form-control" value="{{ $user->username }}" readonly>
                </div>

                <div class="col-md-6 mb-3">
                    <label>IC:</label>
                    <input type="text" name="ic" class="form-control" value="{{ $user->ic }}" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Name:</label>
                    <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Email:</label>
                    <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Phone Number:</label>
                    <input type="text" name="phonenumber" class="form-control" value="{{ $user->phonenumber }}" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Password:</label>
                    <div class="input-group">
                        <input type="password" id="password" name="password" class="form-control" value="{{ $user->password }}">
                        <button type="button" class="btn btn-outline-secondary" onclick="togglePassword()">👁️</button>
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Role:</label>
                    <input type="text" name="role" class="form-control" value="{{ $user->role }}" readonly>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Citizenship:</label>
                    <select name="citizenship" class="form-select" required>
                        <option value="" disabled>Select Citizenship</option>
                        <option value="Malaysian" {{ $user->citizenship == 'Malaysian' ? 'selected' : '' }}>Malaysian</option>
                        <option value="Non-Malaysian" {{ $user->citizenship == 'Non-Malaysian' ? 'selected' : '' }}>Non-Malaysian</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Gender:</label>
                    <select name="gender" class="form-select" required>
                        <option value="" disabled>Select Gender</option>
                        <option value="Male" {{ $user->gender == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ $user->gender == 'Female' ? 'selected' : '' }}>Female</option>
                    </select>
                </div>

                @if($platinum)
                    <div class="col-md-6 mb-3">
                        <label>Assigned CRMP:</label>
                        <input type="text" name="assignedCRMP" class="form-control" value="{{ $platinum->assignedCRMP }}">
                    </div>
                @endif
            </div>

            <div class="d-flex justify-content-between mt-4">
                <button type="submit" class="btn btn-success">Save Changes</button>
                <a href="{{ route('profile.profile') }}" class="btn btn-secondary">Back</a>
            </div>
        </form>
    </div>
</div>
@endsection
