<?php

namespace App\Repositories;

use App\Models\Notification;
use App\Repositories\Eloquent\BaseRepository;
use Illuminate\Database\Eloquent\Collection;

class NotificationRepository extends BaseRepository
{
    public function __construct(
        Notification           $model,
        UserRepository   $userRepository)
    {
        $this->userRepository = $userRepository;
        parent::__construct($model);
    }

    /**
     * @return Collection
     */
    public function getALlUsers(): Collection
    {
        return $this->userRepository->all();
    }

    /**
     * @param int $userId
     * @return Collection|array
     */
    public function getByUserId(int $userId): Collection|array
    {
        return $this->model->query()
            ->where('user_id', $userId)
            ->get();
    }

    /**
     * @return Collection|array
     */
    public function getAll(): Collection|array
    {
        return $this->model->query()
            ->where('user_type', 0)
            ->get();
    }
}
