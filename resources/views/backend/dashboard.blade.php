@extends('backend.layouts.app')

@section('content')
<div class="container my-5">
    <h4 class="mb-4">Blog Posts Overview</h4>
    <div class="row g-4">

        <div class="col-md-4">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Total Blogs</h5>
                    <p class="display-6">{{ $total ?? 0 }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Published (Active)</h5>
                    <p class="display-6 text-success">{{ $published ?? 0 }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Draft (Inactive)</h5>
                    <p class="display-6 text-warning">{{ $draft ?? 0 }}</p>
                </div>
            </div>
        </div>

    </div>

    <!-- Pie Chart -->
    <div class="mt-5">
        <canvas id="blogPieChart"></canvas>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('blogPieChart').getContext('2d');
    const blogPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Published', 'Draft'],
            datasets: [{
                label: 'Blog Posts Status',
                data: [{{ $published ?? 0 }}, {{ $draft ?? 0 }}],
                backgroundColor: [
                    'rgba(54, 162, 235, 0.7)',
                    'rgba(255, 206, 86, 0.7)'
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
</script>
@endsection
