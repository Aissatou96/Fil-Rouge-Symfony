<?php

namespace App\services;

use Swift_Mailer;
use Swift_Message;

class SendMail{

    private Swift_Mailer $mailer;

    public function __construct(Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function send($destination, $object, $sms){
        $message=(new Swift_Message($object))
        ->setFrom('send@gmail.com')
        ->setTo($destination)
        ->setBody($sms);
        $this->mailer->send($message);

    }
}