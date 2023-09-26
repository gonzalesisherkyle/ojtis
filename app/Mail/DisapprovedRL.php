<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DisapprovedRL extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $users, $remarks)
    {
        $this->users = $users;
        $this->user = $user;
        $this->remark = $remarks;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->to($this->user->email)
            ->subject('Recommendation Letter')
            ->markdown('mail.approved-RL', ['data' => $this->users, 'remark' => $this->remark]);
    }
}
