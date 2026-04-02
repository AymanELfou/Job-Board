<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Job;
use App\Models\ProfilEmployer;
use App\Models\ProfilJobseeker;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function dashboard()
{
    $applications = Application::with(['job', 'profilJobseeker'])->get();

    $totalJobs = Job::count();
    $totaltApplications = Application::count();
    $totalJobseekers = ProfilJobseeker::count();
    $totalEmployers = ProfilEmployer::count();

    $totalUsers = $totalJobseekers + $totalEmployers;

    // Monthly application counts
    $monthlyApplications = Application::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
        ->groupBy('month')
        ->orderBy('month')   
        ->get();

    // Monthly user counts for ProfilJobseeker
    $monthlyProfilJobseekers = ProfilJobseeker::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
        ->groupBy('month')
        ->orderBy('month');

    // Monthly user counts for Employer
    $monthlyEmployers = ProfilEmployer::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
        ->groupBy('month')
        ->orderBy('month');

    // Combine the two queries using union
    $monthlyUsers = $monthlyProfilJobseekers->union($monthlyEmployers);

    // Execute the combined query and get the results
    $monthlyUsers = $monthlyUsers->get();

    // Group by month and sum the counts
    $monthlyUsersGrouped = $monthlyUsers->groupBy('month')->map(function ($group) {
        return [
            'month' => $group->first()->month,
            'count' => $group->sum('count'),
        ];
    })->values();


    $jobPostingsTrendsRaw = Job::selectRaw('job_type, COUNT(*) as count')
        ->groupBy('job_type')
        ->get();

    // Standardize labels mapping variations to a unified format
    $standardizedTrends = collect();
    foreach ($jobPostingsTrendsRaw as $trend) {
        $type = strtolower(str_replace(['_', '-'], ' ', $trend->job_type));
        $type = ucwords($type ?: 'Unspecified');
        
        if ($standardizedTrends->has($type)) {
            $standardizedTrends[$type] += $trend->count;
        } else {
            $standardizedTrends[$type] = $trend->count;
        }
    }

    // Prepare data for Job Postings Distribution Chart
    $jobPostingsLabels = $standardizedTrends->keys();
    $jobPostingsCounts = $standardizedTrends->values();

    return view('Admin.dashboard', compact(
        'applications', 
        'totalJobs', 
        'totalUsers', 
        'totaltApplications', 
        'monthlyApplications', 
        'monthlyUsersGrouped', 
        'jobPostingsLabels', 
        'jobPostingsCounts'
    ))->with('success', 'You have logged in as ADMIN.');
}


}
