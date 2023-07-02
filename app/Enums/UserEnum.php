<?php

declare(strict_types=1);

namespace App\Enums;

class UserEnum
{
    const ADMIN = 1;
    const MANAGER = 2;
    const USER = 3;

    const CODE_TIMEOUT = 1;

    const ROLES_MAP = [
        1 => 'Администратор',
        2 => 'Редактор',
        3 => 'Студент',
    ];

    public const SEX = [
        0 => 'Мужской',
        1 => 'Женский'
    ];
}
