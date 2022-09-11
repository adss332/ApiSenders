<?php

namespace App\Service;
use Psr\Log\LoggerInterface;
class TgSender
{
    public function __construct(LoggerInterface $doctrineChannelLogger){
        $this->logger = $doctrineChannelLogger;
    }
    public function send($id,$telegram,$message): string
    {
        if (!empty($id) && !empty($telegram) && !empty($message)){
            $message_send = 'User:'. $telegram;
            $message_send .= '; Отправляю в телеграм по user-id:' . $id . '. сообщение: ' . $message;
            $this->logger->info($message_send);
        }
        return $message_send;
    }
}

