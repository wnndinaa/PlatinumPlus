@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center align-items-center min-vh-100">
    <div class="w-50 p-4 bg-white rounded shadow">
        <h2 class="text-center mb-4">Edit Weekly Progress</h2>

        <form action="{{ route('weeklyprogress.update', $progress->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label" for="startDate">Start Date</label>
                <input class="form-control" type="date" id="startDate" name="startDate" value="{{ $progress->startDate }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label" for="endDate">End Date</label>
                <input class="form-control" type="date" id="endDate" name="endDate" value="{{ $progress->endDate }}" required>
            </div>

            <div class="mb-4">
                <label class="form-label" for="progressinfo">Progress Info</label>
                <textarea class="form-control" id="progressinfo" name="progressinfo" rows="4" required>{{ $progress->progressinfo }}</textarea>
            </div>

            <div class="text-center d-flex justify-content-center gap-3 mt-3">
                <a href="{{ route('weeklyprogress.index') }}" class="btn btn-secondary">Cancel</a>
                <button class="btn btn-primary px-5" type="submit">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection
