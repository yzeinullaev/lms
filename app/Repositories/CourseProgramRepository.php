<?php

namespace App\Repositories;

use App\Enums\ConstantEnum;
use App\Models\CourseProgram;
use App\Repositories\Eloquent\BaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class CourseProgramRepository extends BaseRepository
{
    public function __construct(CourseProgram $model)
    {
        parent::__construct($model);
    }

    /**
     * @param int $course_id
     * @return LengthAwarePaginator
     */
    public function getCourseProgramByCourseId(int $course_id): LengthAwarePaginator
    {
        return $this->model->query()
            ->with('getParentCourse')
            ->where('course_id', $course_id)
            ->latest()->paginate(ConstantEnum::DEFAULT_PAGINATE);
    }

    /**
     * @param int $id
     * @return Collection|array
     */
    public function getByTypeAndId(int $id): Collection|array
    {
        return $this->model->query()
            ->with(['getName', 'getContent'])
            ->where('id', $id)
            ->get();
    }

    /**
     * @return Collection|array
     */
    public function getByTypeAll(): Collection|array
    {
        return $this->model->query()
            ->with(['getName', 'getContent'])
            ->get();
    }

    /**
     * @param $parentId
     * @return LengthAwarePaginator
     */
    public function getLatestPaginateByParentId($parentId): LengthAwarePaginator
    {
        return $this->model->query()
            ->where('course_id', $parentId)
            ->latest()
            ->paginate(ConstantEnum::DEFAULT_PAGINATE);
    }

}
