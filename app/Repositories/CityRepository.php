<?php

namespace App\Repositories;

use App\Enums\ConstantEnum;
use App\Models\City;
use App\Repositories\Eloquent\BaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CityRepository extends BaseRepository
{
    public function __construct(City $model)
    {
        parent::__construct($model);
    }

    /**
     * @param int $region_id
     * @return LengthAwarePaginator
     */
    public function getByCountryId(int $region_id): LengthAwarePaginator
    {
        return $this->model->query()
            ->where('country_id', $region_id)
            ->paginate(ConstantEnum::DEFAULT_PAGINATE);
    }
}
