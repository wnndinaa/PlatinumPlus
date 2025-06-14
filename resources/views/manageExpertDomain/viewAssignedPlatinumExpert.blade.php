@extends('layout')

@section('content')
<div class="container mt-4">
    <h3>Expert Papers for {{ $platinumUser->name }} ({{ $platinumUser->username }})</h3>

    @if ($expertDomains->isEmpty())
        <p>No expert domains found for this Platinum user.</p>
    @else
        @foreach ($expertDomains as $domain)
            <div class="card mb-3">
                <div class="card-header">
                    <strong>Expert Info (Domain: {{ $domain->domain_expertise }})</strong>
                </div>
                <div class="card-body">
                    <p><strong>Name:</strong> {{ $domain->expert_name }}</p>
                    <p><strong>University:</strong> {{ $domain->expert_university }}</p>
                    <p><strong>Occupation:</strong> {{ $domain->expert_occupation }}</p>
                    <p><strong>Phone Number:</strong> {{ $domain->expert_phoneNum }}</p>
                    <p><strong>Email:</strong> {{ $domain->expert_email }}</p>
                </div>
            </div>

            @if ($domain->papers->isNotEmpty())
                <table class="table table-bordered mb-4">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Domain Expertise</th>
                            <th>Paper Title</th>
                            <th>Date</th>
                            <th>DOI</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($domain->papers as $paper)
                        <tr>
                            <td>{{ $loop->parent->iteration }}.{{ $loop->iteration }}</td>
                            <td>{{ $domain->domain_expertise }}</td>
                            <td>{{ $paper->paper_title }}</td>
                            <td>{{ $paper->paper_date }}</td>
                            <td>{{ $paper->paper_DOI }}</td>
                            <td>
                                <a href="{{ route('manageExpertDomain.notifyPlatinum', ['paper_id' => $paper->expertPaper_id]) }}"
                                   class="btn btn-sm btn-warning">Notify</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>No papers found under this domain.</p>
            @endif
        @endforeach
    @endif

    <a href="{{ route('manageExpertDomain.platinumList') }}" class="btn btn-secondary mt-3">Back</a>
</div>
@endsection
