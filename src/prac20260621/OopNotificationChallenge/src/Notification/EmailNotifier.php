<?php

namespace App\Notification;

use App\Entity\Member;
use App\Interfaces\NotifierInterface;

class EmailNotifier implements NotifierInterface
{
    public function send(Member $member, string $message): void
    {
        echo "[Email]" . PHP_EOL;
        echo "To: {$member->getEmail()}" . PHP_EOL;
        echo "Message: {$message}" . PHP_EOL;
        echo "--------------------" . PHP_EOL;
    }

    public function getName(): string
    {
        return 'email';
    }
}
