<?php

namespace App\Logger;

use App\Interfaces\LoggerInterface;

class ConsoleLogger implements LoggerInterface
{
    public function log(string $message): void
    {
        echo "[log] {$message}" . PHP_EOL;
    }
}
