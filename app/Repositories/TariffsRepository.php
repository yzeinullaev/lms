<?php

namespace App\Repositories;

use App\Models\Tariff;
use App\Repositories\Eloquent\BaseRepository;
use Illuminate\Database\Eloquent\Collection;

class TariffsRepository extends BaseRepository
{
    public function __construct(Tariff $model)
    {
        parent::__construct($model);
    }

    /**
     * @param int $id
     * @return Collection|array
     */
    public function getByTypeAndId(int $id): Collection|array
    {
        return $this->model->query()
            ->with(['getName', 'getContent'])
            ->with('getTariffItems', function ($query) {
                $query->with(['getContent', 'getMedia'])
                    ->where('is_active', '1');
            })
            ->where('id', $id)
            ->where('is_active', '1')
            ->get();
    }

    /**
     * @return Collection|array
     */
    public function getByTypeAll(): Collection|array
    {
        return $this->model->query()
            ->with(['getName', 'getContent'])
            ->with('getTariffItems', function ($query) {
                $query->with(['getContent', 'getMedia'])
                    ->where('is_active', '1');
            })
            ->where('is_active', '1')
            ->get();
    }
}
