<?php

namespace App\Jobs;

use App\Models\User;
use App\Mail\WelcomeEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendWelcomeEmail implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
     public $user;

        public function __construct(User $user)
        {
            $this->user = $user;
        }

    /**
     * Execute the job.
     */

        public function handle()
        {
            Mail::to($this->user->email)->send(new WelcomeEmail($this->user));
        }
}
