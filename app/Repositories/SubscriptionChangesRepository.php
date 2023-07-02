<?php

namespace App\Repositories;


use App\Models\SubscriptionChange;
use App\Repositories\Eloquent\BaseRepository;

class SubscriptionChangesRepository extends BaseRepository
{
    public function __construct(SubscriptionChange $model)
    {
        parent::__construct($model);
    }

}
