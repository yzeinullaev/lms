<?php

namespace App\Repositories;

use App\Enums\UserEnum;
use App\Models\User;
use App\Repositories\Eloquent\BaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class UserRepository extends BaseRepository
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    /**
     * @return LengthAwarePaginator
     */
    public function latestPaginate(): LengthAwarePaginator
    {
        return parent::latestPaginate();
    }

    /**
     * @param int $id
     * @return Collection|array
     */
    public function getByTypeAndId(int $id): Collection|array
    {
        return $this->model->query()
            ->where('id', $id)
            ->where('role_id', UserEnum::USER)
            ->get();
    }

    /**
     * @return Collection|array
     */
    public function getByTypeAll(): Collection|array
    {
        return $this->model->query()
            ->where('role_id', UserEnum::USER)
            ->get();
    }

    /**
     * @return Collection|array
     */
    public function getWithNewsNotification(): Collection|array
    {
        return $this->model->query()
            ->select('email')
            ->where('news_notification', 1)
            ->get();
    }
}
