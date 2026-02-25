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


    $jobPostingsTrends = Job::selectRaw('job_type, COUNT(*) as count')
        ->groupBy('job_type')
        ->get();

    // Prepare data for Job Postings Trends Chart
    $jobPostingsLabels = $jobPostingsTrends->pluck('job_type');
    $jobPostingsCounts = $jobPostingsTrends->pluck('count');

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
