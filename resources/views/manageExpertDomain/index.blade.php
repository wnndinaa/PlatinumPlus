@extends('layout')

@section('content')
<h2>My Expert Domain list</h2>

<div>
    <form method="GET" action="{{ route('manageExpertDomain.index') }}" class="row mb-3">
    <div class="col-md-4">
        <input type="text" name="search" class="form-control" placeholder="Search by expert name..." value="{{ $search ?? '' }}">
    </div>
    <div class="col-auto">
        <button type="submit" class="btn btn-secondary">Search</button>
    </div>
    <div class="col-auto">
        <a href="{{ route('manageExpertDomain.index') }}" class="btn btn-outline-secondary">Reset</a>
    </div>
</form>

</div>

<div class="container">
    <div class ="row justify-content center">
        <div class ="col-md-8">
            <a class="btn btn-primary" href="{{route('manageExpertDomain.addExpert')}}"> Add Expert</a>
            <a class="btn btn-secondary ms-2" href="{{ route('manageExpertDomain.platinumExpertList') }}">Other Platinum Expert</a>

        </div>
    </div>
</div>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>No</th>
                <th>Expert Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($expertDomains as $index => $expert)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $expert->expert_name }}</td>
                    <td>
                        <a href="{{ route('manageExpertDomain.editExpert', $expert->expert_id) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('manageExpertDomain.deleteExpert', $expert->expert_id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                        <a href="{{ route('manageExpertDomain.paperList', $expert->expert_id) }}" class="btn btn-sm btn-info">Paper</a>

                    </td>
                </tr>
            @endforeach

            @if($expertDomains->isEmpty())
                <tr>
                    <td colspan="3" class="text-center">No expert domain data found.</td>
                </tr>
            @endif
        </tbody>
    </table>
<div>

</div>
@endsection
