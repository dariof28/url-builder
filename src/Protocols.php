<?php

declare(strict_types=1);

namespace DariofDev\UrlBuilder;

abstract class Protocols
{
    public const FTP = 'ftp';

    public const SFTP = 'sftp';

    public const HTTP = 'http';

    public const HTTPS = 'https';

    public const SMTP = 'smtp';

    public static function all(): array
    {
        return [
            self::FTP,
            self::SFTP,
            self::HTTP,
            self::HTTPS,
            self::SMTP,
        ];
    }
}
