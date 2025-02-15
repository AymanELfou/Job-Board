<x-apps.app-employer>
    <x-slot name="header">
        <h1 class="h2 text-dark" style="font-family: Verdana, Geneva, Tahoma, sans-serif">
            {{ __('Dashboard') }}
        </h1>
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
            margin-top: 
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
            <div class="card text-center ">
                <div class="card-body">
                    <h5 class="card-title">Total Jobs</h5>
                    <span class="display-2 font-weight-bold">{{ $totalJobs }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Total Applications</h5>
                    <span class="display-2 font-weight-bold">{{ $totaltApplications }}</span> <!-- Placeholder value -->
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Total Candidates</h5>
                    <span class="display-2 font-weight-bold">{{ $totalJobseekers }}</span> <!-- Placeholder value -->
                </div>
            </div>
        </div>
    </div>
    

            <!-- Charts Section -->
            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="chart-container">
                        <canvas id="jobPostingsChart" width="600" height="600"></canvas>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="chart-container">
                        <canvas id="applicationsChart" width="600" height="600"></canvas>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="chart-container">
                        <canvas id="candidateQualityChart" width="600" height="600"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Prepare data for Job Postings Overview
        const jobPostingsData = {
            labels: {!! json_encode($monthlyPostings->pluck('month')) !!},
            datasets: [{
                label: 'Job Postings',
                data: {!! json_encode($monthlyPostings->pluck('count')) !!},
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        };

        // Prepare data for Applications Received
        const applicationsData = {
            labels: {!! json_encode($monthlyApplications->pluck('month')) !!},
            datasets: [{
                label: 'Applications Received',
                data: {!! json_encode($monthlyApplications->pluck('count')) !!},
                backgroundColor: 'rgba(153, 102, 255, 0.2)',
                borderColor: 'rgba(153, 102, 255, 1)',
                borderWidth: 1
            }]
        };

        // Prepare data for Candidate Quality Metrics
        const candidateQualityData = {
            labels: {!! json_encode($candidateQuality->pluck('education')) !!},
            datasets: [{
                label: 'Candidates',
                data: {!! json_encode($candidateQuality->pluck('count')) !!},
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)'
                ],
                borderWidth: 1
            }]
        };

        // Render Job Postings Chart
        const ctx1 = document.getElementById('jobPostingsChart').getContext('2d');
        const jobPostingsChart = new Chart(ctx1, {
            type: 'bar', // or 'line'
            data: jobPostingsData,
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Render Applications Chart
        const ctx2 = document.getElementById('applicationsChart').getContext('2d');
        const applicationsChart = new Chart(ctx2, {
            type: 'line',
            data: applicationsData,
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Render Candidate Quality Chart
        const ctx3 = document.getElementById('candidateQualityChart').getContext('2d');
        const candidateQualityChart = new Chart(ctx3, {
            type: 'bar',
            data: candidateQualityData,
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

</x-apps.app-employer>
