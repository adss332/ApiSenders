<?php

namespace App\Service;
use Psr\Log\LoggerInterface;
use App\Service\TgSender;
use App\Service\SmsSender;
class SenderSort
{
    public function __construct(TgSender $TgGenerator, SmsSender $SmsGenerator, LoggerInterface $doctrineChannelLogger){
        $this->logger = $doctrineChannelLogger;
        $this->tgsender = $TgGenerator;
        $this->smssender = $SmsGenerator;
    }
    public function handle($users,$message): void
    {
            for ($i = 0; $i <= count($users); $i++) {
                // telegram
                if(!empty($users[$i]->telegram)) {
                    $this->tgsender->send($users[$i]->id,$users[$i]->telegram,$message);
                } else {
                    if(isset($users[$i]->id)) {
                        $message_err = 'User '. $users[$i]->id . ' не имеет телеграм';
                    } else {
                        $message_err = 'User не имеет id и телеграм';
                    }
                    $this->logger->info($message_err);
                }
                // sms
                if(!empty($users[$i]->sms)) {
                    $this->smssender->send($users[$i]->id,$users[$i]->sms,$message);
                } else {
                    if (isset($users[$i]->id)){
                        $message_err = 'User '. $users[$i]->id . ' не имеет номера для Смс';
                    } else {
                        $message_err = 'User не имеет id и номера для Смс';
                    }
                    $this->logger->info($message_err);
                }
            }

    }
}

