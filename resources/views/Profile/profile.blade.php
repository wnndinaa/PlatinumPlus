@extends('layout')

@section('content')
<div class="content">
    <div class="card p-4">
        <h2 class="mb-4">Profile Information</h2>

        <form>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Username:</label>
                    <input type="text" class="form-control" value="{{ $user->username }}" readonly>
                </div>



                <div class="col-md-6 mb-3">
                    <label>IC:</label>
                    <input type="text" class="form-control" value="{{ $user->ic }}" readonly>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Name:</label>
                    <input type="text" class="form-control" value="{{ $user->name }}" readonly>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Email:</label>
                    <input type="email" class="form-control" value="{{ $user->email }}" readonly>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Phone Number:</label>
                    <input type="text" class="form-control" value="{{ $user->phonenumber }}" readonly>
                </div>


                <div class="col-md-6 mb-3">
                    <label>Password:</label>
                    <input type="password" class="form-control" value="{{ $user->password }}" readonly>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Role:</label>
                    <input type="text" class="form-control" value="{{ $user->role }}" readonly>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Citizenship:</label>
                    <select class="form-select" disabled>
                        <option {{ $user->citizenship == 'Malaysian' ? 'selected' : '' }}>Malaysian</option>
                        <option {{ $user->citizenship == 'Non-Malaysian' ? 'selected' : '' }}>Non-Malaysian</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Gender:</label>
                    <select class="form-select" disabled>
                        <option {{ $user->gender == 'Male' ? 'selected' : '' }}>Male</option>
                        <option {{ $user->gender == 'Female' ? 'selected' : '' }}>Female</option>
                    </select>
                </div>



                @if($platinum)
                    <div class="col-md-6 mb-3">
                        <label>Assigned CRMP:</label>
                        <input type="text" class="form-control" value="{{ $platinum->assignedCRMP }}" readonly>
                    </div>
                @endif
            </div>

            <div class="mt-4">
                <a href="{{ route('profile.edit') }}" class="btn btn-primary">Edit Profile</a>
            </div>
        </form>
    </div>
</div>
@endsection
