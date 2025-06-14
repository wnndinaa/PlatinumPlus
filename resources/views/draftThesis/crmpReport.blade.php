@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Draft Thesis Summary Report</h2>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>No.</th>
                <th>Platinum Name</th>
                <th>Email</th>
                <th>Total Drafts Submitted</th>
                <th>Total Feedback Given</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($reportData as $index => $p)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $p->name }}</td>
                    <td>{{ $p->email }}</td>
                    <td>{{ $p->total_drafts }}</td>
                    <td>{{ $p->total_feedback }}</td>
                    <td>
                        <a href="{{ route('draftthesis.allPlatinumReport', ['min_total_drafts' => $p->total_drafts]) }}" class="btn btn-info btn-sm">
                            View Full Report
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">No data available.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
