<?php

namespace App\Repositories;


use App\Models\Application;
use App\Repositories\Eloquent\BaseRepository;
use Illuminate\Database\Eloquent\Collection;

class ApplicationRepository extends BaseRepository
{
    public function __construct(Application              $model,
                                private CourseRepository $courseRepository
    )
    {
        parent::__construct($model);
    }

    /**
     * @return Collection|array
     */
    public function getAllCourses(): Collection|array
    {
        return $this->courseRepository->getByTypeAll();
    }
}
