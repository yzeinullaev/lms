<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\ReviewsRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ReviewService
{
    /**
     * @param ReviewsRepository $repository
     * @param CourseService $courseService
     */
    public function __construct(
        private ReviewsRepository $repository,
        private CourseService $courseService,
    )
    {
    }

    /**
     * @param int $id
     * @param string $lang
     * @return mixed
     */
    public function getById(int $id, string $lang): mixed
    {
        if ($id === 0) {
            return self::dataMapping($this->repository->getByTypeAll(), $lang);
        }

        return self::dataMapping($this->repository->getByTypeAndId($id), $lang);
    }

    /**
     * @param int $userId
     * @param string $lang
     * @return mixed
     */
    public function getByUserId(int $userId, string $lang): mixed
    {
        return self::dataMapping($this->repository->getByUserId($userId), $lang);
    }

    /**
     * @param $items
     * @param $lang
     * @return mixed
     */
    protected function dataMapping($items, $lang): mixed
    {
        return $items->map(function ($item) use ($lang) {
            return [
                'id' => $item->id,
                'comment' => $item->comment,
                'review_star' => $item->review_star,
                'user_id' => $item->user_id,
                'status' => $item->status,
                'course' => $this->courseService->getById($item->course_id, $lang),
                'created_at' => Carbon::parse($item->created_at)->format('d.m.Y'),
                'updated_at' => Carbon::parse($item->updated_at)->format('d.m.Y'),
            ];
        });
    }

    /**
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model
    {
        return $this->repository->create($data);
    }
}
