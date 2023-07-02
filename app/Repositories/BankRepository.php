<?php

namespace App\Repositories;

use App\Models\Bank;
use App\Repositories\Eloquent\BaseRepository;

class BankRepository extends BaseRepository
{
    public function __construct(Bank $model)
    {
        parent::__construct($model);
    }
}
