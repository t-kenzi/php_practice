<?php

namespace App\Logger;

use App\Interfaces\LoggerInterface;

class FileLogger implements LoggerInterface
{
    private string $filePath;

    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    public function log(string $message): void
    {
        $date = date('Y-m-d H:i:s');
        $logMessage = "[{$date}] {$message}" . PHP_EOL;

        file_put_contents($this->filePath, $logMessage, FILE_APPEND);
    }
}
