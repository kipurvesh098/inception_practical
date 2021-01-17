<?php

namespace App\Listeners;

use App\Events\SendRegisterEmailEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Template;
use App\Models\Custom;
use App\Models\User;

class SendRegisterEmailListener
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
     * @param  SendRegisterEmailEvent  $event
     * @return void
     */
    public function handle(SendRegisterEmailEvent $event)
    {
        $userId         = $event->getUserId();
        $templateId     = $event->getTemplateId();

        $user           = User::find($userId);
        if($user)
        {
            /* Set Template */
            $templateKeywords           = array();
            $templateKeywords['name']   = $user->vName;
            $templateKeywords['email']  = $user->vEmail;
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
