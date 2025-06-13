@extends('layout')

@section('content')
<div class="container mt-4">
    <h3>Experts for Domain Expertise: {{ $domain_expertise }}</h3>

    @if($expertPapers->isEmpty())
        <div class="alert alert-info">No papers found for this domain expertise.</div>
    @else
        <table class="table table-bordered mt-3">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Domain Expertise</th>
                    <th>Paper Title</th>
                    <th>Expert Name</th>
                    <th>Date</th>
                    <th>DOI</th>
                </tr>
            </thead>
            <tbody>
                @foreach($expertPapers as $index => $paper)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $paper->domain_expertise }}</td>
                        <td>{{ $paper->paper_title }}</td>
                        <td>{{ $paper->expert_name }}</td>
                        <td>{{ $paper->paper_date }}</td>
                        <td>{{ $paper->paper_DOI }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <div class="d-flex justify-content-end mt-3">
        <a href="{{ route('manageExpertDomain.platinumExpertList') }}" class="btn btn-outline-primary">Back</a>
    </div>
</div>
@endsection
