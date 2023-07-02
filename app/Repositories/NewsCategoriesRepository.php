<?php

namespace App\Repositories;

use App\Models\NewsCategory;
use App\Repositories\Eloquent\BaseRepository;
use Illuminate\Database\Eloquent\Collection;

class NewsCategoriesRepository extends BaseRepository
{
    public function __construct(NewsCategory $model)
    {
        parent::__construct($model);
    }

    /**
     * @param int $id
     * @param $childSlug
     * @return Collection|array
     */
    public function getByTypeAndId(int $id, $childSlug): Collection|array
    {
        return $this->model->query()
            ->with('getName')
            ->with('getNews', function ($query) use ($childSlug) {
                $query = $query->with(['getName', 'getContent', 'getMedia'])
                    ->where('is_active', '1');

                if ($childSlug) {
                    $query->where('slug', $childSlug);
                }

                return $query;
            })
            ->where('id', $id)
            ->where('is_active', '1')
            ->get();
    }

    /**
     * @param $childSlug
     * @return Collection|array
     */
    public function getByTypeAll($childSlug): Collection|array
    {
        $query = $this->model->query()
            ->with('getName')
            ->with('getNews', function ($query) use ($childSlug) {
                $query = $query->with(['getName', 'getContent', 'getMedia'])
                    ->where('is_active', '1');

                if ($childSlug) {
                    $query->where('slug', $childSlug);
                }

                return $query;
            })
            ->where('is_active', '1')
            ->get();

        return $query;
    }
}
