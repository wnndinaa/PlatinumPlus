@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center align-items-center min-vh-100">
    <div class="w-50 p-4 bg-white rounded shadow">
        <h2 class="text-center mb-4">Add Weekly Progress</h2>

        <form action="{{ route('weeklyprogress.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label" for="startDate">Start Date</label>
                <input class="form-control" type="date" id="startDate" name="startDate" required>
            </div>

            <div class="mb-3">
                <label class="form-label" for="endDate">End Date</label>
                <input class="form-control" type="date" id="endDate" name="endDate" required>
            </div>

            <div class="mb-3">
                <label class="form-label" for="progressinfo">Progress Info</label>
                <textarea class="form-control" id="progressinfo" name="progressinfo" rows="4" required></textarea>
            </div>

            <div class="text-center d-flex justify-content-center gap-3 mt-3">
                <a href="{{ route('weeklyprogress.index') }}" class="btn btn-secondary">Cancel</a>
                <button class="btn btn-primary px-5" type="submit">Submit</button>
            </div>
        </form>
    </div>
</div>
@endsection
