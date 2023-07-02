<?php

namespace App\Repositories;

use App\Models\Page;
use App\Repositories\Eloquent\BaseRepository;
use Illuminate\Support\Collection;
use \Illuminate\Database\Eloquent\Collection as DbCollection;

class PagesRepository extends BaseRepository
{
    public function __construct(Page $model)
    {
        parent::__construct($model);
    }

    /**
     * @param $slug
     * @return Collection
     */
    public function getPageWithItems($slug): Collection
    {
        $data = $this->model->query()
            ->with('getName')
            ->with('getPageItems', function ($query) {
                $query->where('is_active', '1');
            });

        if (!empty($slug)) {
            $data->where('slug', $slug);
        }

        $data->where('is_active', '1');

        return collect($data->first());
    }

    /**
     * @return DbCollection|array
     */
    public function getMenu(): DbCollection|array
    {
        return $this->model->query()
            ->with('getName')
            ->where('menu', 1)
            ->whereNotIn('slug', ['main', 'footer', 'header'])
            ->where('is_active', '1')
            ->get();
    }
}
