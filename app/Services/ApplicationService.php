<?php

declare(strict_types=1);

namespace App\Services;


use App\Repositories\ApplicationRepository;
use Illuminate\Database\Eloquent\Model;

class ApplicationService
{

    public function __construct(private ApplicationRepository $repository
    )
    {
    }

    /**
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model
    {
        if (isset($data['lang'])) {
            unset($data['lang']);
        }
        return $this->repository->create($data);
    }
}
