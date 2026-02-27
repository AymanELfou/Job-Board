<x-apps.app-employer>

    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center py-1 px-4 gap-2">
            <div class="ml-2">
                <h2 class="text-4xl font-extrabold text-gray-900 tracking-tight">
                    My <span class="text-[#a31b1b]">Candidates</span>
                </h2>
                <p class="text-gray-400 text-sm font-medium">Manage and review potential hires</p>
            </div>
        </div>
    </x-slot>

    <div class="py-10 bg-gray-50/50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="mb-6">
                @include('incs.alert')
            </div>

            @if($candidates->isEmpty())
                <div class="bg-blue-50/50 border border-blue-100 rounded-[2rem] p-10 text-center">
                    <div class="w-20 h-20 mx-auto bg-blue-100 rounded-full flex items-center justify-center text-blue-500 text-4xl mb-4">
                        <i class="bi bi-people"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">No Candidates Found</h3>
                    <p class="text-gray-500">You don't have any candidates yet.</p>
                </div>
            @else
                <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 py-5 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center">
                        <h3 class="text-lg font-bold text-gray-800">Recent Candidates ({{ $candidates->count() }})</h3>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-50/50 border-b border-gray-100 text-sm md:text-base">
                                    <th class="px-6 py-4 font-bold text-gray-500 uppercase tracking-wider">Candidate</th>
                                    <th class="px-6 py-4 font-bold text-gray-500 uppercase tracking-wider">Applied For</th>
                                    <th class="px-6 py-4 font-bold text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-4 font-bold text-gray-500 uppercase tracking-wider text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach ($candidates as $candidate)
                                <tr class="hover:bg-gray-50 transition-colors duration-200 group">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-4">
                                            <div class="w-12 h-12 rounded-full overflow-hidden bg-gray-100 border border-gray-200 flex-shrink-0">
                                                <img src="{{ asset('imgs/candi.png') }}" alt="Candidate" class="w-full h-full object-cover">
                                            </div>
                                            <div>
                                                <div class="font-bold text-gray-900">{{ $candidate->profilJobseeker->fullName ?? 'N/A' }}</div>
                                                <div class="text-sm text-gray-500">{{ $candidate->profilJobseeker->contact_information ?? 'N/A' }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2 text-sm text-gray-700 font-medium whitespace-nowrap">
                                            <i class="bi bi-briefcase-fill text-gray-400"></i>
                                            {{ $candidate->job->titre }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold border
                                            {{ $candidate->status == 'pending' ? 'bg-yellow-50 text-yellow-700 border-yellow-200' : '' }}
                                            {{ $candidate->status == 'approved' ? 'bg-green-50 text-green-700 border-green-200' : '' }}
                                            {{ $candidate->status == 'rejected' ? 'bg-red-50 text-red-700 border-red-200' : '' }}">
                                            {{ ucfirst($candidate->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex items-center justify-end gap-3 flex-wrap">
                                            <!-- Status Update Dropdown Form -->
                                            <form action="{{ route('applications.updateStatus', $candidate->id) }}" method="POST" class="m-0">
                                                @csrf
                                                @method('PUT')
                                                <select name="status" class="bg-white border text-xs border-gray-200 font-bold text-gray-700 rounded-lg focus:ring-[#a31b1b] focus:border-[#a31b1b] py-2 px-3 transition-colors duration-200" onchange="this.form.submit()">
                                                    <option value="pending" {{ $candidate->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="approved" {{ $candidate->status == 'approved' ? 'selected' : '' }}>Approved</option>
                                                    <option value="rejected" {{ $candidate->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                                </select>
                                            </form>
                                            
                                            <!-- View Profile Link -->
                                            <a href="{{ route('candidates.show', $candidate->id) }}" class="inline-flex items-center justify-center p-2 bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white rounded-lg transition-colors duration-200" title="View Profile">
                                                <i class="bi bi-person-lines-fill text-lg"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
            
        </div>
    </div>
</x-apps.app-employer>