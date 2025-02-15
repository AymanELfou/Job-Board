<x-app-layout>
    <x-slot name="header">
        <h2 class="h1 text-dark" style="font-family: Verdana, Geneva, Tahoma, sans-serif">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @if (isset($success))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ $success }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

    </div>
    @endif
 
<style>
    .card {
        border: 1px solid #007bff; /* Bordure bleue */
        border-radius: 10px; /* Coins arrondis */
        transition: transform 0.3s; /* Animation de transformation */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Ombre légère */
    }

    .card:hover {
        transform: scale(1.05); /* Zoom au survol */
    }

    .card-title {
        color: #007bff; /* Couleur du titre */
        
        font-family: Verdana, Geneva, Tahoma, sans-serif;
    }

    .display-2 {
        color: #333; /* Couleur du nombre */
        font-size: 2.5rem; /* Taille de police */
    }

    .card-body {
        padding: 20px; /* Espacement intérieur */
    }
</style>

<!-- Overview Cards -->
<div class="row mb-4 mt-5">
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title">Recent Applications</h5>
                <span class="display-2 font-weight-bold">{{ $totaltApplications }}</span>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title">Total Users</h5>
                <span class="display-2 font-weight-bold">{{ $totalUsers }}</span> <!-- Placeholder value -->
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title">Total Jobs</h5>
                <span class="display-2 font-weight-bold">{{ $totalJobs }}</span> <!-- Placeholder value -->
            </div>
        </div>
    </div>
</div>

            <!-- Charts Section -->
            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="chart-container">
                        <canvas id="applicationTrendsChart" width="600" height="600"></canvas>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="chart-container">
                        <canvas id="userGrowthChart" width="600" height="600"></canvas>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="chart-container">
                        <canvas id="jobPostingsTrendsChart" width="600" height="400"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Prepare data for Application Trends Chart
        const applicationData = {
            labels: @json($monthlyApplications->pluck('month')),
            datasets: [{
                label: 'Monthly Applications',
                data: @json($monthlyApplications->pluck('count')),
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        };

        // Application Trends Chart
        const ctx1 = document.getElementById('applicationTrendsChart').getContext('2d');
        const applicationTrendsChart = new Chart(ctx1, {
            type: 'bar',
            data: applicationData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });




        // Prepare data for User Growth Chart
        const userData = {
            labels: @json($monthlyUsersGrouped->pluck('month')),
            datasets: [{
                label: 'Monthly Users',
                data: @json($monthlyUsersGrouped->pluck('count')),
                backgroundColor: 'rgba(153, 102, 255, 0.2)',
                borderColor: 'rgba(153, 102, 255, 1)',
                borderWidth: 1
            }]
        };
        
        // User Growth Chart
        const userGrowthCtx = document.getElementById('userGrowthChart').getContext('2d');
        const userGrowthChart = new Chart(userGrowthCtx, {
            type: 'bar',
            data: userData, // Use the prepared userData
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        

        // Prepare data for Job Postings Trends Chart
        const jobPostingsData = {
            labels: @json($jobPostingsLabels), // Use dynamic labels
            datasets: [{
                label: 'Job Postings',
                data: @json($jobPostingsCounts), // Use dynamic counts
                backgroundColor: [
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(255, 159, 64, 0.6)',
                    'rgba(255, 205, 86, 0.6)',
                    'rgba(75, 192, 192, 0.6)',
                ],
            }]
        };

        // Job Postings Trends Chart
        const jobPostingsTrendsCtx = document.getElementById('jobPostingsTrendsChart').getContext('2d');
        const jobPostingsTrendsChart = new Chart(jobPostingsTrendsCtx, {
            type: 'pie',
            data: jobPostingsData, // Use the prepared jobPostingsData
            options: {
                responsive: true,
            }
        });

    </script>
</x-app-layout>
