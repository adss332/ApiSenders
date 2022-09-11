<?php

namespace App\Service;
use Psr\Log\LoggerInterface;
class SmsSender
{
    public function __construct(LoggerInterface $doctrineChannelLogger){
        $this->logger = $doctrineChannelLogger;
    }
    public function send($id,$sms,$message): string
    {
        if (!empty($id) && !empty($sms) && !empty($message)){

            $message_send = 'Телефон:'. $sms;
            $message_send .= '; Отправляю смс по user-id:' . $id . '. сообщение: ' . $message;
            $this->logger->info($message_send);
        }
        return $message_send;
    }
}

