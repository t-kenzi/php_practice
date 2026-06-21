<?php

namespace App\Notification;

use App\Interfaces\NotifierInterface;

class EmailNotifier implements NotifierInterface
{
    public function send(string $to, string $message): void
    {
        echo "[メール通知]\n";
        echo "宛先: {$to}\n";
        echo "本文: {$message}\n";
        echo "--------------------\n";
    }
}