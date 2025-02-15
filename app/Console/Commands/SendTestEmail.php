<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendTestEmail extends Command
{
    protected $signature = 'email:test';
    protected $description = 'Send a test email to verify configuration';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $toEmail = 'aymanel2025@gmail.com'; // Replace with your test recipient email
        Mail::raw('This is a test email from Laravel.', function ($message) use ($toEmail) {
                $message->to($toEmail)
                    ->subject('Test Email'); 
        });

        $this->info('Test email sent successfully.');
    }
}
