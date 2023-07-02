<?php

namespace App\Repositories;

use App\Models\Country;
use App\Repositories\Eloquent\BaseRepository;

class CountryRepository extends BaseRepository
{
    public function __construct(Country $model)
    {
        parent::__construct($model);
    }
}
