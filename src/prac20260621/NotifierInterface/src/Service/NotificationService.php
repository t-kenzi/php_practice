<?php

namespace App\Service;

use App\Interfaces\NotifierInterface;
use App\Interfaces\LoggerInterface;

class NotificationService
{
    private NotifierInterface $notifier;
    private LoggerInterface $logger;

    public function __construct(
        NotifierInterface $notifier,
        LoggerInterface $logger
    ) {
        $this->notifier = $notifier;
        $this->logger = $logger;
    }

    public function notify(string $to, string $message): void
    {
        $this->notifier->send($to, $message);

        $this->logger->log("通知を送信しました。宛先: {$to} / 本文: {$message}");
    }
}