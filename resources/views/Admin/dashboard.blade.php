<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center py-1 px-4 gap-2">
            <div class="ml-2">
                <h2 class="text-4xl font-extrabold text-gray-900 tracking-tight">
                    Admin <span class="text-[#a31b1b]">Dashboard</span>
                </h2>
                <p class="text-gray-400 text-sm font-medium">Performance metrics & metrics Overview</p>
            </div>
        </div>
    </x-slot>

    <div class="py-6 bg-gray-50/50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if (isset($success))
                <div id="success-alert" class="mb-6 p-3 bg-green-50 border border-green-200 text-green-700 rounded-xl flex items-center gap-3 transition-opacity duration-500">
                    <i class="bi bi-check-circle-fill"></i>
                    <span class="font-bold text-sm">{{ $success }}</span>
                </div>
            @endif

            <!-- Premium Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                <!-- Applications Card -->
                <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-gray-100 hover:shadow-xl transition-all duration-300 group">
                    <div class="flex items-center gap-6">
                        <div class="w-16 h-16 rounded-2xl bg-[#a31b1b]/5 flex items-center justify-center text-3xl text-[#a31b1b] border border-[#a31b1b]/10 group-hover:bg-[#a31b1b] group-hover:text-white transition-all duration-300">
                            <i class="bi bi-file-earmark-person"></i>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-gray-400 uppercase tracking-widest">Recent Applications</p>
                            <h3 class="text-4xl font-extrabold text-gray-900">{{ $totaltApplications }}</h3>
                        </div>
                    </div>
                </div>

                <!-- Users Card -->
                <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-gray-100 hover:shadow-xl transition-all duration-300 group">
                    <div class="flex items-center gap-6">
                        <div class="w-16 h-16 rounded-2xl bg-[#a31b1b]/5 flex items-center justify-center text-3xl text-[#a31b1b] border border-[#a31b1b]/10 group-hover:bg-[#a31b1b] group-hover:text-white transition-all duration-300">
                            <i class="bi bi-people"></i>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-gray-400 uppercase tracking-widest">Total Users</p>
                            <h3 class="text-4xl font-extrabold text-gray-900">{{ $totalUsers }}</h3>
                        </div>
                    </div>
                </div>

                <!-- Jobs Card -->
                <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-gray-100 hover:shadow-xl transition-all duration-300 group">
                    <div class="flex items-center gap-6">
                        <div class="w-16 h-16 rounded-2xl bg-[#a31b1b]/5 flex items-center justify-center text-3xl text-[#a31b1b] border border-[#a31b1b]/10 group-hover:bg-[#a31b1b] group-hover:text-white transition-all duration-300">
                            <i class="bi bi-briefcase"></i>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-gray-400 uppercase tracking-widest">Total Jobs</p>
                            <h3 class="text-4xl font-extrabold text-gray-900">{{ $totalJobs }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Analytics Section -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                <!-- Monthly Applications Chart -->
                <div class="bg-white rounded-[2rem] p-6 shadow-sm border border-gray-100 h-[380px] flex flex-col">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h4 class="text-lg font-bold text-gray-800">Applications</h4>
                        </div>
                        <div class="text-[#a31b1b]">
                            <i class="bi bi-bar-chart-fill"></i>
                        </div>
                    </div>
                    <div class="relative flex-grow">
                        <canvas id="applicationTrendsChart"></canvas>
                    </div>
                </div>

                <!-- User Growth Chart -->
                <div class="bg-white rounded-[2rem] p-6 shadow-sm border border-gray-100 h-[380px] flex flex-col">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h4 class="text-lg font-bold text-gray-800">User Growth</h4>
                        </div>
                        <div class="text-[#a31b1b]">
                            <i class="bi bi-person-plus-fill"></i>
                        </div>
                    </div>
                    <div class="relative flex-grow">
                        <canvas id="userGrowthChart"></canvas>
                    </div>
                </div>

                <!-- Job Distribution Pie Chart -->
                <div class="bg-white rounded-[2rem] p-6 shadow-sm border border-gray-100 h-[380px] flex flex-col">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h4 class="text-lg font-bold text-gray-800">Distribution</h4>
                        </div>
                        <div class="text-[#a31b1b]">
                            <i class="bi bi-pie-chart-fill"></i>
                        </div>
                    </div>
                    <div class="relative flex-grow">
                        <canvas id="jobPostingsTrendsChart"></canvas>
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
            // Auto-dismiss alert
            const alert = document.getElementById('success-alert');
            if (alert) {
                setTimeout(() => {
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                }, 4000);
            }

            // Chart.js defaults
            Chart.defaults.font.family = "'Montserrat', sans-serif";
            Chart.defaults.color = '#718096';
            Chart.defaults.plugins.legend.labels.usePointStyle = true;
            Chart.defaults.plugins.legend.labels.padding = 20;

            // Application Trends Chart
            const ctx1 = document.getElementById('applicationTrendsChart').getContext('2d');
            new Chart(ctx1, {
                type: 'bar',
                data: {
                    labels: @json($monthlyApplications->pluck('month')),
                    datasets: [{
                        label: 'Applications',
                        data: @json($monthlyApplications->pluck('count')),
                        backgroundColor: '#a31b1b',
                        borderRadius: 12,
                        maxBarThickness: 40,
                    }]
                },
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

            // User Growth Chart
            const userGrowthCtx = document.getElementById('userGrowthChart').getContext('2d');
            new Chart(userGrowthCtx, {
                type: 'line',
                data: {
                    labels: @json($monthlyUsersGrouped->pluck('month')),
                    datasets: [{
                        label: 'Total Users',
                        data: @json($monthlyUsersGrouped->pluck('count')),
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
                },
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

            // Job Postings Trends Chart (Doughnut for modern look)
            const jobPostingsTrendsCtx = document.getElementById('jobPostingsTrendsChart').getContext('2d');
            new Chart(jobPostingsTrendsCtx, {
                type: 'doughnut',
                data: {
                    labels: @json($jobPostingsLabels),
                    datasets: [{
                        data: @json($jobPostingsCounts),
                        backgroundColor: [
                            '#a31b1b',
                            '#dc2626',
                            '#ef4444',
                            '#f87171',
                            '#fca5a5',
                            '#fee2e2'
                        ],
                        borderWidth: 0,
                        hoverOffset: 20
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '70%',
                    plugins: {
                        legend: {
                            position: 'bottom',
                            padding: 30
                        }
                    }
                }
            });
        });
    </script>
</x-app-layout>
