@extends('layout')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Edit Expert</h3>

    <form action="{{ route('manageExpertDomain.update', $expert->expert_id) }}" method="POST">
        @csrf
        @method('PUT') {{-- Use PUT for updating --}}

        <div class="mb-3">
            <label for="expert_name" class="form-label">Expert Name</label>
            <input type="text" name="expert_name" class="form-control @error('expert_name') is-invalid @enderror" value="{{ old('expert_name', $expert->expert_name) }}">
            @error('expert_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="expert_university" class="form-label">University</label>
            <input type="text" name="expert_university" class="form-control @error('expert_university') is-invalid @enderror" value="{{ old('expert_university', $expert->expert_university) }}">
            @error('expert_university')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="expert_occupation" class="form-label">Occupation</label>
            <input type="text" name="expert_occupation" class="form-control @error('expert_occupation') is-invalid @enderror" value="{{ old('expert_occupation', $expert->expert_occupation) }}">
            @error('expert_occupation')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="expert_phoneNum" class="form-label">Phone Number</label>
            <input type="text" name="expert_phoneNum" class="form-control @error('expert_phoneNum') is-invalid @enderror" value="{{ old('expert_phoneNum', $expert->expert_phoneNum) }}">
            @error('expert_phoneNum')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="expert_email" class="form-label">Email</label>
            <input type="email" name="expert_email" class="form-control @error('expert_email') is-invalid @enderror" value="{{ old('expert_email', $expert->expert_email) }}">
            @error('expert_email')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="domain_expertise" class="form-label">Domain Expertise</label>
            <input type="text" name="domain_expertise" class="form-control @error('domain_expertise') is-invalid @enderror" value="{{ old('domain_expertise', $expert->domain_expertise) }}">
            @error('domain_expertise')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('manageExpertDomain.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
