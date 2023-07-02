<?php

namespace App\Repositories;

use App\Models\ErrorCodes;
use App\Repositories\Eloquent\BaseRepository;

class ErrorCodeRepository extends BaseRepository
{
    public function __construct(ErrorCodes $model)
    {
        parent::__construct($model);
    }

    public function getMessage(string $code, string $lang)
    {
        return $this->model->query()
            ->where('code', $code)
            ->first()
            ->getMessage->{$lang};
    }
}
