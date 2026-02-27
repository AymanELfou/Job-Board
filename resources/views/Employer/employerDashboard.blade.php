<x-apps.app-employer>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center py-1 px-4 gap-2">
            <div class="ml-2">
                <h2 class="text-4xl font-extrabold text-gray-900 tracking-tight">
                    Employer <span class="text-[#a31b1b]">Dashboard</span>
                </h2>
                <p class="text-gray-400 text-sm font-medium">Dashboard Overview & Performance Metrics</p>
            </div>
        </div>
    </x-slot>

    <div class="py-6 bg-gray-50/50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Welcoming Alert -->
            <div class="mb-8 p-4 bg-white border border-gray-100 shadow-sm rounded-[2rem] flex items-center gap-4 transition-all duration-300">
                <div class="w-12 h-12 rounded-full bg-green-50 flex items-center justify-center text-green-500 text-2xl border border-green-100">
                    <i class="bi bi-check2-circle"></i>
                </div>
                <div>
                    <h4 class="text-lg font-bold text-gray-900 mb-1">Welcome back!</h4>
                    <p class="text-sm font-medium text-gray-500 mb-0">You are currently managed as an <span class="px-2 py-0.5 rounded text-xs font-bold bg-[#a31b1b] text-white">Employer</span>. Everything looks great today.</p>
                </div>
            </div>

            <!-- Premium Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                <!-- Job Postings Card -->
                <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-gray-100 hover:shadow-xl transition-all duration-300 group">
                    <div class="flex items-center gap-6">
                        <div class="w-16 h-16 rounded-2xl bg-[#a31b1b]/5 flex items-center justify-center text-3xl text-[#a31b1b] border border-[#a31b1b]/10 group-hover:bg-[#a31b1b] group-hover:text-white transition-all duration-300">
                            <i class="bi bi-briefcase"></i>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-gray-400 uppercase tracking-widest">Job Postings</p>
                            <h3 class="text-4xl font-extrabold text-gray-900">{{ $totalJobs }}</h3>
                        </div>
                    </div>
                </div>

                <!-- Applications Card -->
                <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-gray-100 hover:shadow-xl transition-all duration-300 group">
                    <div class="flex items-center gap-6">
                        <div class="w-16 h-16 rounded-2xl bg-[#a31b1b]/5 flex items-center justify-center text-3xl text-[#a31b1b] border border-[#a31b1b]/10 group-hover:bg-[#a31b1b] group-hover:text-white transition-all duration-300">
                            <i class="bi bi-file-earmark-text"></i>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-gray-400 uppercase tracking-widest">Applications</p>
                            <h3 class="text-4xl font-extrabold text-gray-900">{{ $totaltApplications }}</h3>
                        </div>
                    </div>
                </div>

                <!-- Candidates Card -->
                <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-gray-100 hover:shadow-xl transition-all duration-300 group">
                    <div class="flex items-center gap-6">
                        <div class="w-16 h-16 rounded-2xl bg-[#a31b1b]/5 flex items-center justify-center text-3xl text-[#a31b1b] border border-[#a31b1b]/10 group-hover:bg-[#a31b1b] group-hover:text-white transition-all duration-300">
                            <i class="bi bi-people"></i>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-gray-400 uppercase tracking-widest">Candidates</p>
                            <h3 class="text-4xl font-extrabold text-gray-900">{{ $totalJobseekers }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Analytics Section -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                <!-- Job Postings Chart -->
                <div class="bg-white rounded-[2rem] p-6 shadow-sm border border-gray-100 h-[380px] flex flex-col">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h4 class="text-lg font-bold text-gray-800">Monthly Job Postings</h4>
                        </div>
                        <div class="text-[#a31b1b]">
                            <i class="bi bi-bar-chart-fill"></i>
                        </div>
                    </div>
                    <div class="relative flex-grow">
                        <canvas id="jobPostingsChart"></canvas>
                    </div>
                </div>

                <!-- Applications Received Chart -->
                <div class="bg-white rounded-[2rem] p-6 shadow-sm border border-gray-100 h-[380px] flex flex-col">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h4 class="text-lg font-bold text-gray-800">Applications Received</h4>
                        </div>
                        <div class="text-[#a31b1b]">
                            <i class="bi bi-graph-up"></i>
                        </div>
                    </div>
                    <div class="relative flex-grow">
                        <canvas id="applicationsChart"></canvas>
                    </div>
                </div>

                <!-- Candidate Demographics Chart -->
                <div class="bg-white rounded-[2rem] p-6 shadow-sm border border-gray-100 h-[380px] flex flex-col">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h4 class="text-lg font-bold text-gray-800">Candidate Demographics</h4>
                        </div>
                        <div class="text-[#a31b1b]">
                            <i class="bi bi-pie-chart-fill"></i>
                        </div>
                    </div>
                    <div class="relative flex-grow">
                        <canvas id="candidateQualityChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        .chart-container {
            position: relative;
            margin: auto;
            height: 100%;
            width: 100%;
        }
    </style>
    @endpush

    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Chart.js defaults
            Chart.defaults.font.family = "'Montserrat', sans-serif";
            Chart.defaults.color = '#718096';
            Chart.defaults.plugins.legend.labels.usePointStyle = true;
            Chart.defaults.plugins.legend.labels.padding = 20;

            // Prepare data for Job Postings Overview
            const jobPostingsData = {
                labels: {!! json_encode($monthlyPostings->pluck('month')) !!},
                datasets: [{
                    label: 'Job Postings',
                    data: {!! json_encode($monthlyPostings->pluck('count')) !!},
                    backgroundColor: '#a31b1b',
                    borderRadius: 8,
                    maxBarThickness: 40,
                }]
            };

            // Prepare data for Applications Received
            const applicationsData = {
                labels: {!! json_encode($monthlyApplications->pluck('month')) !!},
                datasets: [{
                    label: 'Applications Received',
                    data: {!! json_encode($monthlyApplications->pluck('count')) !!},
                    borderColor: '#a31b1b',
                    backgroundColor: 'rgba(163, 27, 27, 0.1)',
                    fill: true,
                    tension: 0.4,
                    borderWidth: 4,
                    pointRadius: 6,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#a31b1b',
                    pointBorderWidth: 4
                }]
            };

            // Prepare data for Candidate Quality Metrics
            const candidateQualityData = {
                labels: {!! json_encode($candidateQuality->pluck('education')) !!},
                datasets: [{
                    data: {!! json_encode($candidateQuality->pluck('count')) !!},
                    backgroundColor: [
                        '#a31b1b',
                        '#dc2626',
                        '#ef4444',
                        '#f87171',
                        '#fca5a5',
                        '#fee2e2'
                    ],
                    borderWidth: 0,
                    hoverOffset: 10
                }]
            };

            // Render Job Postings Chart
            const ctx1 = document.getElementById('jobPostingsChart').getContext('2d');
            new Chart(ctx1, {
                type: 'bar',
                data: jobPostingsData,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { color: '#f7fafc', drawBorder: false },
                            ticks: { stepSize: 1 }
                        },
                        x: {
                            grid: { display: false, drawBorder: false }
                        }
                    }
                }
            });

            // Render Applications Chart
            const ctx2 = document.getElementById('applicationsChart').getContext('2d');
            new Chart(ctx2, {
                type: 'line',
                data: applicationsData,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { color: '#f7fafc', drawBorder: false },
                            ticks: { stepSize: 1 }
                        },
                        x: {
                            grid: { display: false, drawBorder: false }
                        }
                    }
                }
            });

            // Render Candidate Quality Chart (Doughnut)
            const ctx3 = document.getElementById('candidateQualityChart').getContext('2d');
            new Chart(ctx3, {
                type: 'doughnut',
                data: candidateQualityData,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '70%',
                    plugins: {
                        legend: {
                            position: 'bottom',
                            padding: 20
                        }
                    }
                }
            });
        });
    </script>
</x-apps.app-employer>
