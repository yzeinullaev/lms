<?php

namespace App\Repositories;

use App\Models\CourseLesson;
use App\Repositories\Eloquent\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class CourseLessonsRepository extends BaseRepository
{
    public function __construct(CourseLesson             $model,
                                MediaMultiLangRepository $mediaMultiLangRepository)
    {
        $this->mediaMultiLangRepository = $mediaMultiLangRepository;
        parent::__construct($model);
    }


    /**
     * @param Request $request
     * @return mixed
     * @throws \Throwable
     */
    public function storeLessonFile(Request $request): mixed
    {
        return $this->mediaMultiLangRepository->storeMultiMedia($request, 'lesson_files', 'file');
    }

    /**
     * @param Request $request
     * @param int $id
     * @return void
     * @throws \Throwable
     */
    public function updateLessonFile(Request $request, int $id): void
    {
        $this->mediaMultiLangRepository->updateMultiMedia($this->findOrFail($id), $request, 'lesson_files', 'file');
    }

    /**
     * @param Request $request
     * @param string $directoryName
     * @param string $key
     * @return mixed
     * @throws \Throwable
     */
    public function creteMultiMediaFiles(Request $request, string $directoryName, string $key = 'video'): mixed
    {
        return $this->mediaMultiLangRepository->storeMedia($request, $directoryName, $key);
    }

    /**
     * @param $id
     * @param Request $request
     * @param string $directoryName
     * @param string $key
     * @return void
     * @throws \Throwable
     */
    public function updateMultiMediaFiles($id, Request $request, string $directoryName, string $key = 'video'): void
    {
        $this->mediaMultiLangRepository->updateMedia($this->findOrFail($id), $request, $directoryName, $key);
    }

    /**
     * @param int $courseId
     * @return Collection|array
     */
    public function getByCourseId(int $courseId): Collection|array
    {
        return $this->model->query()
            ->with(['getName', 'getContent', 'getFile', 'getMediaVideo'])
            ->where('course_id', $courseId)
            ->where('is_active', '1')
            ->get();
    }

}
