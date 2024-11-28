<?php

namespace App\Http\Controllers;

use App\Mail\JobApplicationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TestEmailController extends Controller
{
    public function testEmail()
    {
        $email = 'aymanel2025@gmail.com'; // Use a valid email address for testing
        $jobTitle = 'Test Job';
        $jobSeekerName = 'Test Job Seeker';

        try {
            Mail::to($email)->send(new JobApplicationMail($jobTitle, $jobSeekerName));
            return 'Email sent successfully!';
        } catch (\Exception $e) {
            return 'Email sending failed: ' . $e->getMessage();
        }
    }
}
