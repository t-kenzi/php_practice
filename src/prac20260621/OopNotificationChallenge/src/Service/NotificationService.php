<?php

namespace App\Service;

use App\Entity\Member;
use App\Interfaces\LoggerInterface;
use App\Interfaces\MessageFormatterInterface;
use App\Interfaces\NotifierInterface;

class NotificationService
{
    private NotifierInterface $notifier;
    private MessageFormatterInterface $formatter;
    private LoggerInterface $logger;

    public function __construct(
        NotifierInterface $notifier,
        MessageFormatterInterface $formatter,
        LoggerInterface $logger
    ) {
        $this->notifier = $notifier;
        $this->formatter = $formatter;
        $this->logger = $logger;
    }

    public function notify(Member $member): void
    {
        $message = $this->formatter->format($member);

        $this->notifier->send($member, $message);

        $this->logger->log("{$this->notifier->getName()}通知を送信しました: {$member->getName()}");
    }
}
