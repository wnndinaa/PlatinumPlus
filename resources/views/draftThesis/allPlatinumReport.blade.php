@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Draft Thesis Report</h2>

    <form method="GET" action="{{ route('draftThesis.allPlatinumReport') }}" class="row g-3 align-items-end mb-4">
        <div class="col-md-4">
            <label for="min_total_drafts" class="form-label">Min Total Drafts Submitted</label>
            <input type="number" class="form-control" name="min_total_drafts" id="min_total_drafts" value="{{ request('min_total_drafts') }}">
        </div>

        <div class="col-md-4">
            <label for="latest_updated" class="form-label">Latest Submitted Date</label>
            <input type="date" class="form-control" name="latest_updated" id="latest_updated" value="{{ request('latest_updated') }}">
        </div>

        <div class="col-md-4 d-flex gap-2">
            <button type="submit" class="btn btn-primary">Filter</button>
            <a href="{{ route('draftThesis.allPlatinumReport') }}" class="btn btn-outline-secondary">Reset</a>
        </div>
    </form>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>No.</th>
                <th>Platinum Name</th>
                <th>Email</th>
                <th>Total Submitted Drafts</th>
                <th>Latest Updated</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($reportData as $index => $p)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $p->name }}</td>
                    <td>{{ $p->email }}</td>
                    <td>{{ $p->total_drafts }}</td>
                    <td>
                        {{ $p->latest_updated
                            ? \Carbon\Carbon::parse($p->latest_updated)->format('d/m/Y H:i')
                            : 'N/A' }}
                    </td>
                </tr>
            @empty
                @if(request()->filled('min_total_drafts') || request()->filled('latest_updated'))
                    <tr>
                        <td colspan="5" class="text-center text-danger">No data matched your filter criteria.</td>
                    </tr>
                @else
                    <tr>
                        <td colspan="5" class="text-center text-muted">No data found.</td>
                    </tr>
                @endif
            @endforelse
        </tbody>
    </table>

</div>
@endsection
