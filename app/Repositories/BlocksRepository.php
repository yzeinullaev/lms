<?php

namespace App\Repositories;

use App\Models\Block;
use App\Repositories\Eloquent\BaseRepository;
use Illuminate\Database\Eloquent\Collection;

class BlocksRepository extends BaseRepository
{
    public function __construct(Block $model)
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
                'name' => $item->getName->ru,
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
            ->with(['getName', 'getContent'])
            ->with('getBlockItems', function ($query) {
                $query->with(['getContent', 'getMedia']);
            })
            ->where('id', $id)
            ->where('is_active', '1')
            ->get();
    }
}
