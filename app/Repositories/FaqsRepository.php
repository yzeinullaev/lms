<?php

namespace App\Repositories;

use App\Models\Faq;
use App\Repositories\Eloquent\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class FaqsRepository extends BaseRepository
{
    public function __construct(Faq $model)
    {
        parent::__construct($model);
    }

    /**
     * @param int $id
     * @return Builder[]|Collection
     */
    public function getByTypeAndId(int $id): array|Collection
    {
        return $this->model->query()
            ->with(['getQuestion', 'getAnswer', 'getMetaTitle', 'getMetaDescription', 'getMetaKeywords'])
            ->where('is_active', '1')
            ->when($id, function ($query) use ($id) {
                if ($id) {
                    $query->where('id', $id);
                }

                return $query;
            })
            ->get();
    }
}
