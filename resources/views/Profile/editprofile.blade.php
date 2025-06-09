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
                <input type="text" name="name" class="form-control" value="{{ $profile->name }}" required>
            </div>

            <div class="mb-3">
                <label>Email:</label>
                <input type="email" name="email" class="form-control" value="{{ $profile->email }}" required>
            </div>

            <div class="mb-3">
                <label>Phone Number:</label>
                <input type="text" name="phonenumber" class="form-control" value="{{ $profile->phonenumber }}" required>
            </div>

            <div class="mb-3">
                <label>IC:</label>
                <input type="text" name="ic" class="form-control" value="{{ $profile->ic }}" required>
            </div>

            <div class="mb-3">
                <label>Role:</label>
                <input type="text" name="role" class="form-control" value="{{ $profile->role }}" required>
            </div>

            <button type="submit" class="btn btn-success">Save Changes</button>
            <a href="{{ route('profile.profile') }}" class="btn btn-secondary" style="margin-left: 10px;">Back</a>
        </form>
    </div>
</div>
@endsection
