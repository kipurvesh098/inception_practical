<?php

namespace App\Listeners;

use App\Events\SendResetPasswordEmailEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Template;
use App\Models\Custom;
use App\Models\User;

class SendResetPasswordEmailListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SendResetPasswordEmailEvent  $event
     * @return void
     */
    public function handle(SendResetPasswordEmailEvent $event)
    {
        $userId         = $event->getUserId();
        $templateId     = $event->getTemplateId();

        $user           = User::find($userId);
        if($user)
        {
            /* Set Template */
            $templateKeywords           = array();
            $templateKeywords['link']   = route('password.reset',['token' => $user->vPasswordResetToken]);
            $templateData               =  Template::setEmailTemplate($templateKeywords,$templateId);

            /* Send Mail */
            $emailData                  = array();
            $emailData['to']            = $user->vEmail;
            $emailData['subject']       = $templateData['subject'];
            $emailData['body']          = $templateData['body'];
            $flag                       = Custom::sendHtmlMail($emailData);
        }
    }
}
