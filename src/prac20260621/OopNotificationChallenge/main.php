<?php

require_once __DIR__ . '/autoload.php';

use App\Entity\Member;
use App\Formatter\BirthdayMessageFormatter;
use App\Formatter\CampaignMessageFormatter;
use App\Logger\ConsoleLogger;
use App\Logger\FileLogger;
use App\Notification\EmailNotifier;
use App\Notification\SlackNotifier;
use App\Service\NotificationService;

$taro = new Member(1, '田中太郎', 'taro@example.com', 'regular');
$hanako = new Member(2, '佐藤花子', 'hanako@example.com', 'premium');

$consoleLogger = new ConsoleLogger();
$fileLogger = new FileLogger(__DIR__ . '/src/storage/notification.log');

$birthdayService = new NotificationService(
    new EmailNotifier(),
    new BirthdayMessageFormatter(500),
    $consoleLogger
);

$birthdayService->notify($taro);

echo PHP_EOL;

$campaignService = new NotificationService(
    new SlackNotifier('#campaign'),
    new CampaignMessageFormatter('週末セールを開催中です。'),
    $fileLogger
);

$campaignService->notify($hanako);
