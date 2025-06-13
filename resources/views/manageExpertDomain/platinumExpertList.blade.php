@extends('layout')

@section('content')
<div class="container mt-4">
    <h3>Platinum Experts</h3>

    <form method="GET" class="row mb-3">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control" placeholder="Search by name/domain expertise..." value="{{ $search ?? '' }}">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-secondary">Search</button>
        </div>
        <div class="col-auto">
            <a href="{{ route('manageExpertDomain.platinumExpertList') }}" class="btn btn-outline-secondary">Reset</a>
        </div>
    </form>

    <table class="table table-bordered">
       <thead>
    <tr>
        <th>No.</th>
        <th>Domain Expertise</th>
        <th>View Expert</th>
    </tr>
</thead>
<tbody>
    @forelse ($platinums as $index => $platinum)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $platinum->domain_expertise }}</td>
            <td>
                <a href="{{ route('manageExpertDomain.viewDomainExpertise', ['domain_expertise' => $platinum->domain_expertise]) }}" class="btn btn-sm btn-info">
                    View
                </a>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="3" class="text-center">No Domain Expertise found.</td>
        </tr>
    @endforelse
</tbody>


    </table>

    <div class="d-flex justify-content-end mt-3">
        <a href="{{ route('manageExpertDomain.index') }}" class="btn btn-outline-primary">Back</a>
    </div>
</div>
@endsection
