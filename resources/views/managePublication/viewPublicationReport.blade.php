@extends('layout')

@section('content')
    <div class="container">
        <h2 class="mb-4">Publication Report</h2>
        <form method="GET" action="{{ route('publication.report') }}" class="row g-3 mb-4">
            <div class="col-md-4">
                <label for="month" class="form-label">Month</label>
                <select name="month" id="month" class="form-select">
                    <option value="">All Months</option>
                    @for ($m = 1; $m <= 12; $m++)
                        <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>
                            {{ DateTime::createFromFormat('!m', $m)->format('F') }}</option>
                    @endfor
                </select>
            </div>

            <div class="col-md-4">
                <label for="year" class="form-label">Year</label>
                <select name="year" id="year" class="form-select">
                    <option value="">All Years</option>
                    @foreach ($availableYears as $y)
                        <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>
                            {{ $y }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4 align-self-end">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </form>

        <!-- Summary Info -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card p-3">
                    <strong>Total Platinum Publications:</strong>
                    <span>{{ $totalPublications }}</span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-3">
                    <strong>Top Platinum Contributor:</strong>
                    <span>{{ $topContributorName }}</span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-3">
                    <strong>Most Active Month:</strong>
                    <span>{{ $mostActiveMonth ?? 'N/A' }}</span>
                </div>
            </div>
        </div>

        <!-- Chart -->
        <div class="card p-3 mb-4">
            <canvas id="publicationChart"></canvas>
        </div>

        <!-- Publication Table -->
        <div class="card p-3">
            <h4 class="mb-3">Publication List</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Date</th>
                        <th>Type</th>
                        <th>DOI</th>
                        <th>Username</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($publications as $index => $pub)
                        <tr>
                            <td>{{ $publications->firstItem() + $index }}</td>
                            <td>{{ $pub->publication_title }}</td>
                            <td>{{ $pub->publication_author }}</td>
                            <td>{{ $pub->publication_date }}</td>
                            <td>{{ $pub->publication_type }}</td>
                            <td>{{ $pub->publication_DOI }}</td>
                            <td>{{ $pub->username }}</td>
                            <td>
                                <a href="{{ asset('storage/' . $pub->publication_file) }}" target="_blank"
                                    class="btn btn-info btn-sm">
                                    View
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $publications->links() }}
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('publicationChart').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($chartLabels),
                datasets: [{
                    label: 'Publications per Month',
                    data: @json($chartData),
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        precision: 0
                    }
                }
            }
        });
    </script>
@endsection
