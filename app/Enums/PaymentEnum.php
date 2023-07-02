<?php

declare(strict_types=1);

namespace App\Enums;

class PaymentEnum
{
    const NEW = 0;
    const PAYED = 1;
    const FAILED = 2;

    const DEFAULT_CURRENCY = 'KZT';

    const PAYMENT_SUCCESS = 'success';
    const PAYMENT_FAILED = 'failed';

    const DEFAULT_SUBSCRIBE = 30; // days
}
