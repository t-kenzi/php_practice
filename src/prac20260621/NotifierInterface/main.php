<?php

require_once __DIR__ . '/autoload.php';

use App\Notification\EmailNotifier;
use App\Notification\SmsNotifier;
use App\Notification\LineNotifier;
use App\Notification\SlackNotifier;
use App\Service\NotificationService;
use App\Logger\FileLogger;

$logger = new FileLogger(__DIR__ . '/src/storage/log.txt');

$emailNotifier = new EmailNotifier();
$emailService = new NotificationService($emailNotifier, $logger);
$emailService->notify('taro@example.com', '会員登録が完了しました。');

$smsNotifier = new SmsNotifier();
$smsService = new NotificationService($smsNotifier, $logger);
$smsService->notify('090-1234-5678', '認証コードは123456です。');

$lineNotifier = new LineNotifier();
$lineService = new NotificationService($lineNotifier, $logger);
$lineService->notify('user_line_id_001', '予約日前日のお知らせです。');

$slackNotifier = new SlackNotifier();
$slackService = new NotificationService($slackNotifier, $logger);
$slackService->notify('#general', '本日のデプロイが完了しました。');