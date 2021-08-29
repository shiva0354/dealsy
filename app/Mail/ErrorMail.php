<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ErrorMail extends Mailable
{
    use Queueable, SerializesModels;

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
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // $emails = explode(',', SystemSetting::errorReportingMail());
        $emails = ['shiva0354@gmail.com'];

        return $this->view('mails.error-mail')
            ->to($emails)
            ->subject($this->message)
            ->with([
                'url' => $this->url,
                'inputs' => $this->inputs,
                'stacktrace' => $this->stacktrace,
            ]);
    }
}
