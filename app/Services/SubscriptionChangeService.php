<?php

declare(strict_types=1);

namespace App\Services;


use App\Repositories\SubscriptionChangesRepository;

class SubscriptionChangeService
{
    /**
     * @param SubscriptionChangesRepository $repository
     */
    public function __construct(private SubscriptionChangesRepository $repository)
    {
    }

}
