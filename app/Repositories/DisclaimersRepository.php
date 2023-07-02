<?php

namespace App\Repositories;

use App\Models\Disclaimer;
use App\Repositories\Eloquent\BaseRepository;
use Illuminate\Database\Eloquent\Collection;

class DisclaimersRepository extends BaseRepository
{
    public function __construct(Disclaimer $model)
    {
        parent::__construct($model);
    }

    /**
     * @return array
     */
    public function getList(): array
    {
        $data = $this->model->query()->get();
        return $data->map(function ($item) {
            return [
                'value' => $item->id,
                'name' => $item->content,
            ];
        })->toArray();
    }

    /**
     * @param int $id
     * @return Collection|array
     */
    public function getByTypeAndId(int $id): Collection|array
    {
        return $this->model->query()
            ->with('getContent')
            ->where('id', $id)
            ->where('is_active', '1')
            ->get();
    }
}
