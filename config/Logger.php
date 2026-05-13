<?php

class Logger
{
    private const LOG_DIR = __DIR__ . '/../logs';
    private const LOG_FILE = self::LOG_DIR . '/app.log';

    public static function info(string $message): void
    {
        self::write('INFO', $message);
    }

    public static function warning(string $message): void
    {
        self::write('WARNING', $message);
    }

    public static function error(string $message): void
    {
        self::write('ERROR', $message);
    }

    private static function write(string $level, string $message): void
    {
        if (!is_dir(self::LOG_DIR)) {
            mkdir(self::LOG_DIR, 0777, true);
        }

        $timestamp = date('Y-m-d H:i:s');
        $remoteIp = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
        $line = sprintf("[%s] [%s] [%s] %s", $timestamp, $level, $remoteIp, trim($message));

        file_put_contents(self::LOG_FILE, $line . PHP_EOL, FILE_APPEND | LOCK_EX);
    }
}
