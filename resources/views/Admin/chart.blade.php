<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-4xl text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="row g-2 mb-2">
        {{-- Charts --}}
        <div class="col-md-8 d-flex flex-column gap-2">
            <div class="card p-2 bg-white rounded">
                <div class="card-header">
                    <h5 class="mb-0">Books Added In The Past 30 Days</h5>
                </div>
                <div class="card-body">
                    <canvas id="jobseekerchart"></canvas>
                </div>
            </div>
    
            <div class="card p-2 bg-white rounded">
                <div class="card-header">
                    <h5 class="mb-0">Members Added In The Past 30 Days</h5>
                </div>
                <div class="card-body">
                    <canvas id="employerchart"></canvas>
                </div>
            </div>
    
            <div class="card p-2 bg-white rounded">
                <div class="card-header">
                    <h5 class="mb-0">Borrows Added In The Past 30 Days</h5>
                </div>
                <div class="card-body">
                    <canvas id="jobchart"></canvas>
                </div>
            </div>
    
            <div class="card p-2 bg-white rounded">
                <div class="card-header">
                    <h5 class="mb-0">Applications Added In The Past 30 Days</h5>
                </div>
                <div class="card-body">
                    <canvas id="applicationchart"></canvas>
                </div>
            </div>
        </div>
    </div>
    

        {{-- Top records --}}
        <div class="flex flex-col gap-2">
            {{-- TOTAL STOCKS --}}
            <x-dash-card header="Total Stock">
                <div class="grid h-full place-items-center">
                    <span class="text-9xl font-bold">{{ $totalStock }}</span>
                </div>
            </x-dash-card>

            {{-- BOOKS --}}
            <x-dash-card header="Top Books">
                <ul>
                    <li class="flex justify-between text-xs font-bold text-gray-500">
                        <span>ISBN</span>
                        <span>COUNT</span>
                    </li>

                    @foreach ($topBooks as $topBook)
                        <li class="flex justify-between">
                            <span>{{ $topBook->isbn }}</span>
                            <span>{{ $topBook->borrow_count }}</span>
                        </li>
                    @endforeach
                </ul>
            </x-dash-card>

            {{-- CATEGORIES --}}
            <x-dash-card header="Top Categories">
                <ul>
                    <li class="flex justify-between text-xs font-bold text-gray-500">
                        <span>Name</span>
                        <span>COUNT</span>
                    </li>

                    @foreach ($topCategories as $topCategorie)
                        <li class="flex justify-between">
                            <span>{{ $topCategorie->name }}</span>
                            <span>{{ $topCategorie->borrow_count }}</span>
                        </li>
                    @endforeach
                </ul>
            </x-dash-card>

            {{-- MEMBERS --}}
            <x-dash-card header="Top Members">
                <ul>
                    <li class="flex justify-between text-xs font-bold text-gray-500">
                        <span>CNIE</span>
                        <span>COUNT</span>
                    </li>

                    @foreach ($topMembers as $topMember)
                        <li class="flex justify-between">
                            <span>{{ $topMember->cnie }}</span>
                            <span>{{ $topMember->borrow_count }}</span>
                        </li>
                    @endforeach
                </ul>
            </x-dash-card>

{{-- Rencent Activities --}}
        </div>
        <x-dash-card header="Rencent Activities" class="col-span-3">
            <a href="{{ route('logs.index') }}">
                <div class="flex flex-col gap-2">
                    @foreach ($audits as $audit)
                        <x-audit-item :audit="$audit" />
                    @endforeach
                </div>
            </a>
        </x-dash-card>
    </div>
    <script>
        var ctx1 = document.getElementById('bookschart').getContext('2d');
        var myChart1 = new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: @json($booksChart['labels']),
                datasets: [{
                    label: 'Books',
                    data: @json($booksChart['data']),
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1 // Increment scale by 1
                        },
                    }
                }
            }
        });

        var ctx2 = document.getElementById('memeberschart').getContext('2d');
        var myChart2 = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: @json($membersChart['labels']),
                datasets: [{
                    label: 'Members',
                    data: @json($membersChart['data']),
                    backgroundColor: 'rgba(192, 75, 192, 0.2)',
                    borderColor: 'rgba(192, 75, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1 // Increment scale by 1
                        },
                    }
                }
            }
        });

        var ctx3 = document.getElementById('borrowschart').getContext('2d');
        var myChart3 = new Chart(ctx3, {
            type: 'bar',
            data: {
                labels: @json($borrowsChart['labels']),
                datasets: [{
                    label: 'Borrows',
                    data: @json($borrowsChart['data']),
                    backgroundColor: 'rgba(192, 192, 75, 0.2)',
                    borderColor: 'rgba(192, 192, 75, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1 // Increment scale by 1
                        },
                    }
                }
            }
        });
    </script>
</x-app-layout>