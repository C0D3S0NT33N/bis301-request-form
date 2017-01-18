<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AccountInformation extends Mailable
{
    use Queueable, SerializesModels;

    public $account;
    public $members;

    /**
     * Create a new message instance.
     *
     * @param $account
     * @param $members
     */
    public function __construct($account, $members)
    {
        $this->account = $account;
        $this->members = $members;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('BIS-301 Hosting Account Information')
                    ->view('emails/account_info')
                    ->with([
                        'account' => $this->account,
                        'members' => $this->members
                    ]);
    }
}
