<?php

namespace App\Jobs;

use App\Mail\MailForgotPassword;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendEmailForgotPass implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email;
    protected $code;
    protected $name;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email,$code, $name)
    {
        $this->email = $email;
        $this->code = $code;
        $this->name = $name;
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws \SendGrid\Mail\TypeException
     */
    public function handle()
    {
        try {
            $emailSend = $this->email;
            $contentEmail = new MailForgotPassword($this->code, $this->name);
            Mail::to($emailSend)->send($contentEmail);
        } catch (Exception $e) {
            Log::error("[SendEmailRegisterComplete][handle] error " . $e->getMessage());
            throw new Exception('[SendEmailRegisterComplete][handle] error ' . $e->getMessage());
        }
    }
}
