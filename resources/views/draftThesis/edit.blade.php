@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center align-items-center min-vh-100">
    <div class="w-50 p-4 bg-white rounded shadow">
        <h2 class="text-center mb-4">Edit Draft Thesis</h2>

        <form action="{{ route('draftThesis.update', $draft->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
            <label class="form-label" for="title">Thesis Title</label>
            <input class="form-control" type="text" id="title" name="title" value="{{ $draft->title }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label" for="thesislink">Thesis Link</label>
                <textarea class="form-control" id="thesislink" name="thesislink" cols="30" rows="4" required>{{ $draft->thesislink }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label" for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3">{{ $draft->description }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label" for="number">Number</label>
                <input class="form-control" type="number" id="number" name="number" value="{{ $draft->number }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label" for="startDate">Start Date</label>
                <input class="form-control" type="date" id="startDate" name="startDate" value="{{ $draft->startDate }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label" for="enddate">End Date</label>
                <input class="form-control" type="date" id="enddate" name="enddate" value="{{ $draft->enddate }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label" for="totalpage">Total Pages</label>
                <input class="form-control" type="number" id="totalpage" name="totalpage" value="{{ $draft->totalpage }}" required>
            </div>

            <div class="mb-4">
                <label class="form-label" for="prepdays">Preparation Days</label>
                <input class="form-control" type="number" id="prepdays" name="prepdays" value="{{ $draft->prepdays }}" required>
            </div>

            <div class="text-center d-flex justify-content-center gap-3 mt-3">
                <a href="{{ route('draftThesis.index') }}" class="btn btn-secondary">Cancel</a>
                <button class="btn btn-primary px-5" type="submit">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection
