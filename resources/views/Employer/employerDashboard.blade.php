<x-apps.app-employer>
    <x-slot name="header">
        <h2 class="fw-bold text-dark m-0" style="font-family: 'Inter', sans-serif; letter-spacing: -0.025em;">
            Dashboard Overview
        </h2>
    </x-slot>

 


    <style>
        .stats-card {
            border: none;
            border-radius: 16px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background: #ffffff;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            overflow: hidden;
            position: relative;
        }
    
        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .stats-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: #a31b1b;
        }
    
        .card-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            background: rgba(163, 27, 27, 0.1);
            color: #a31b1b;
            font-size: 1.5rem;
        }
    
        .stat-value {
            font-size: 2.25rem;
            font-weight: 700;
            color: #1a202c;
            line-height: 1;
        }

        .stat-label {
            color: #718096;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.025em;
            font-size: 0.875rem;
        }

        .chart-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 1.25rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            height: clamp(300px, 40vh, 400px);
            display: flex;
            flex-direction: column;
        }

        .chart-container {
            flex-grow: 1;
            position: relative;
        }

        .chart-header {
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.95rem;
        }
    </style>
    
    <div class="py-6">
        <!-- Welcoming Alert -->
        <div class="alert border-0 shadow-sm d-flex align-items-center p-4 mb-5" style="background: white; border-radius: 16px;">
            <div class="bg-success-subtle p-3 rounded-circle me-3">
                <i class="bi bi-check2-circle text-success fs-3"></i>
            </div>
            <div>
                <h4 class="mb-1 fw-bold">Welcome back!</h4>
                <p class="mb-0 text-secondary">You are currently managed as an <span class="badge bg-danger">Employer</span>. Everything looks great today.</p>
            </div>
        </div>

        <!-- Overview Cards -->
        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="stats-card p-4">
                    <div class="card-icon">
                        <i class="bi bi-briefcase"></i>
                    </div>
                    <div class="stat-label mb-1">Total Job Postings</div>
                    <div class="stat-value">{{ $totalJobs }}</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stats-card p-4">
                    <div class="card-icon">
                        <i class="bi bi-file-earmark-text"></i>
                    </div>
                    <div class="stat-label mb-1">Total Applications</div>
                    <div class="stat-value">{{ $totaltApplications }}</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stats-card p-4">
                    <div class="card-icon">
                        <i class="bi bi-people"></i>
                    </div>
                    <div class="stat-label mb-1">Active Candidates</div>
                    <div class="stat-value">{{ $totalJobseekers }}</div>
                </div>
            </div>
        </div>
        
        <!-- Charts Section -->
        <div class="row g-4 overflow-hidden">
            <div class="col-lg-4">
                <div class="chart-card">
                    <div class="chart-header">
                        <i class="bi bi-bar-chart-line text-danger"></i>
                        Monthly Job Postings
                    </div>
                    <div class="chart-container text-center">
                        <canvas id="jobPostingsChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="chart-card">
                    <div class="chart-header">
                        <i class="bi bi-graph-up text-danger"></i>
                        Applications Received
                    </div>
                    <div class="chart-container text-center">
                        <canvas id="applicationsChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="chart-card">
                    <div class="chart-header">
                        <i class="bi bi-pie-chart text-danger"></i>
                        Candidate Demographics
                    </div>
                    <div class="chart-container text-center">
                        <canvas id="candidateQualityChart"></canvas>
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
