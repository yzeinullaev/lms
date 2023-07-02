<?php

namespace App\Repositories;

use App\Models\Review;
use App\Repositories\Eloquent\BaseRepository;
use Illuminate\Database\Eloquent\Collection;

class ReviewsRepository extends BaseRepository
{
    public function __construct(
        Review           $model,
        UserRepository   $userRepository,
        CourseRepository $courseRepository)
    {
        $this->userRepository = $userRepository;
        $this->courseRepository = $courseRepository;
        parent::__construct($model);
    }

    /**
     * @return Collection
     */
    public function getUsers(): Collection
    {
        return $this->userRepository->all();
    }

    /**
     * @return Collection
     */
    public function getCourses(): Collection
    {
        return $this->courseRepository->all();
    }

    /**
     * @param int $id
     * @return Collection|array
     */
    public function getByTypeAndId(int $id): Collection|array
    {
        return $this->model->query()
            ->where('id', $id)
            ->where('status', '1')
            ->get();
    }

    /**
     * @return Collection|array
     */
    public function getByTypeAll(): Collection|array
    {
        return $this->model->query()
            ->where('status', '1')
            ->get();
    }

    /**
     * @param int $userId
     * @return Collection|array
     */
    public function getByUserId(int $userId): Collection|array
    {
        return $this->model->query()
            ->where('user_id', $userId)
            ->where('status', '1')
            ->get();
    }
}
