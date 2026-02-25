<style>
    .job-card {
        border: none;
        border-radius: 20px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        background: #ffffff;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        border: 1px solid #f1f5f9;
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .job-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        border-color: rgba(163, 27, 27, 0.1);
    }

    .job-card-header {
        padding: 1.5rem;
        background: rgba(163, 27, 27, 0.02);
        border-bottom: 1px solid #f1f5f9;
    }

    .job-title {
        font-size: 1.25rem;
        font-weight: 800;
        color: #1a202c;
        margin-bottom: 0.5rem;
    }

    .company-badge {
        display: inline-flex;
        align-items: center;
        padding: 4px 12px;
        background: rgba(163, 27, 27, 0.1);
        color: #a31b1b;
        border-radius: 100px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.025em;
    }

    .job-meta-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: #718096;
        font-size: 0.875rem;
        margin-bottom: 0.5rem;
    }

    .job-meta-item i {
        color: #a31b1b;
        opacity: 0.7;
    }

    .job-description {
        color: #4a5568;
        font-size: 0.9375rem;
        line-height: 1.6;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .action-btn-admin {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
        background: white;
        border: 1px solid #edf2f7;
        color: #a31b1b;
    }

    .action-btn-admin:hover {
        background: #a31b1b;
        color: white;
        border-color: #a31b1b;
        transform: scale(1.1);
    }

    .action-btn-delete:hover {
        background: #dc2626;
        border-color: #dc2626;
    }
</style>

<div class="row g-4">
    @foreach($jobs as $job)
        <div class="col-xs-12 col-sm-6 col-md-4">
            <div class="job-card">
                <div class="job-card-header">
                    <div class="company-badge mb-2">
                        <i class="bi bi-building me-1"></i> {{ $job['company'] }}
                    </div>
                    <h3 class="job-title">{{ $job['titre'] }}</h3>
                    <div class="job-meta-item">
                        <i class="bi bi-geo-alt"></i> {{ $job['location'] }}
                    </div>
                </div>
                
                <div class="p-4 flex-grow-1">
                    <div class="grid grid-cols-2 gap-2 mb-4">
                        <div class="job-meta-item">
                            <i class="bi bi-clock"></i> {{ $job['job_type'] }}
                        </div>
                        <div class="job-meta-item">
                            <i class="bi bi-tag"></i> {{ $job['categorie'] }}
                        </div>
                        <div class="job-meta-item">
                            <i class="bi bi-wallet2"></i> {{ $job['salaire'] }}
                        </div>
                        <div class="job-meta-item">
                            <i class="bi bi-file-earmark-text"></i> {{ $job['type_contrat'] }}
                        </div>
                    </div>
                    
                    <h5 class="text-sm font-bold uppercase tracking-wider text-gray-400 mb-2">Description</h5>
                    <p class="job-description">{{ $job['description'] }}</p>
                </div>

                <div class="p-4 pt-0 mt-auto border-t border-gray-50 flex justify-between items-center">
                    <span class="text-xs text-gray-400">
                        <i class="bi bi-calendar3 me-1"></i> {{ $job['date_publication'] }}
                    </span>
                    
                    <div class="flex gap-2">
                        <form action="{{ route('jobs.destroy', $job->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="action-btn-admin action-btn-delete" onclick="return confirm('Are you sure you want to delete this job posting?')">
                                <i class="bi bi-trash3"></i>
                            </button>
                        </form>
                        {{-- <a href="{{ route('jobs.edit', $job->id) }}" class="action-btn-admin">
                            <i class="bi bi-pencil-square"></i>
                        </a> --}}
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    
    @if(method_exists($jobs, 'links'))
        <div class="col-12 mt-8 d-flex justify-content-center">
            {{ $jobs->links() }}
        </div>
    @endif
</div>
