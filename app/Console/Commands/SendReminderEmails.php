<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReminderEmail; // ✅ Make sure this is imported
use Illuminate\Support\Facades\Log;

class SendReminderEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:reminder-emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send subscription reminder emails';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $users = User::all(); // Or add filtering logic

        foreach ($users as $user) {
            // Send the reminder email
            Mail::to($user->email)->send(new ReminderEmail($user));

            // Log the action
            Log::info("Reminder email sent to: " . $user->email);
        }

        Log::info("All reminder emails sent at " . now());
    }
}
