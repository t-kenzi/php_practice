<?php

spl_autoload_register(function (string $class): void {
    $prefix = 'App\\';
    $baseDir = __DIR__ . '/src/';

    // App\ で始まらないクラスは対象外
    if (strpos($class, $prefix) !== 0) {
        return;
    }

    // App\Notification\EmailNotifier
    // ↓
    // Notification\EmailNotifier
    $relativeClass = substr($class, strlen($prefix));

    // Notification\EmailNotifier
    // ↓
    // Notification/EmailNotifier.php
    $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';

    if (file_exists($file)) {
        require_once $file;
    }
});