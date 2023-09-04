<?php

namespace App\Jobs;

use App\Traits\EMails;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels,EMails;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected  $data;
    public function __construct($data)
    {
        $this->data = $data;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->sendMail($this->data, 'emails.email_verification', 'Email verification code', $this->data['receiver_email'], $this->data['sender_email']);

    }
}
