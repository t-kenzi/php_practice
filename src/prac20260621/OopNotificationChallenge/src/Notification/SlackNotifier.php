<?php

namespace App\Notification;

use App\Entity\Member;
use App\Interfaces\NotifierInterface;

class SlackNotifier implements NotifierInterface
{
    private string $channel;

    public function __construct(string $channel)
    {
        $this->channel = $channel;
    }

    public function send(Member $member, string $message): void
    {
        echo "[Slack]" . PHP_EOL;
        echo "Channel: {$this->channel}" . PHP_EOL;
        echo "Message: {$message}" . PHP_EOL;
        echo "--------------------" . PHP_EOL;
    }

    public function getName(): string
    {
        return 'slack';
    }
}
