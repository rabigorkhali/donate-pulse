<?php

namespace App\Jobs;

use App\Mail\DonationReceivedEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailAfterDonationMade implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $mailData;

    public function __construct($mailData)
    {
        $this->mailData = $mailData;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $mailData = $this->mailData;
        Mail::to($this->mailData['donationReceiverEmail'])->send(new DonationReceivedEmail($this->mailData));
    }
}
