<?php

namespace App\Services;


class StatusService
{

    const REGISTERED = 0;
    const PENDING = 1;
    const ACCEPTED = 2;
    const IN_PROGRESS = 3;
    const COMPLETED = 4;
    const CANCELED = 5;

    public static $statusesNames = [
        self::REGISTERED => 'zarejestrowane',
        self::PENDING => 'oczekujący z przydzieleniem',
        self::ACCEPTED => 'zaakceptowane do realizacji',
        self::IN_PROGRESS => 'w trakcie realizacji',
        self::COMPLETED => 'zrealizowane',
        self::CANCELED => 'anulowane',
    ];

    public static function getStatuses()
    {
        return [
            self::REGISTERED,
            self::PENDING,
            self::ACCEPTED,
            self::CANCELED,
            self::IN_PROGRESS,
            self::COMPLETED
        ];
    }
}
