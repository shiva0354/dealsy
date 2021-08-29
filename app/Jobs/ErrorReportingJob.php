<?php

namespace App\Jobs;

use App\Mail\ErrorMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class ErrorReportingJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $url;
    public $inputs;
    public $message;
    public $stacktrace;

    public function __construct($message, $stacktrace, $url, $inputs)
    {
        $this->url = $url;
        $this->inputs = $inputs;
        $this->message = $message;
        $this->stacktrace = $stacktrace;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::send(new ErrorMail($this->message, $this->stacktrace, $this->url, $this->inputs));
    }
}
