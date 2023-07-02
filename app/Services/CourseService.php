<?php

declare(strict_types=1);

namespace App\Services;


use App\Models\Course;
use App\Repositories\CourseRepository;

class CourseService
{
    /**
     * @param CourseRepository $repository
     * @param CourseProgramService $courseProgramService
     * @param CourseLessonService $courseLessonService
     */
    public function __construct(
        private CourseRepository $repository,
        private CourseProgramService $courseProgramService,
        private CourseLessonService $courseLessonService,
    ) {
    }

    /**
     * @param int $id
     * @param string $lang
     * @param null $childSlug
     * @return mixed
     */
    public function getById(int $id, string $lang, $childSlug = null): mixed
    {
        if ($id === 0) {
            return self::dataMapping($this->repository->getByTypeAll($childSlug), $lang);
        }

        return self::dataMapping($this->repository->getByTypeAndId($id, $childSlug), $lang);
    }

    /**
     * @param $data
     * @param string $lang
     * @return array
     */
    public function getByData($data, string $lang): array
    {
        return self::dataMapping($data, $lang);
    }

    /**
     * @param $items
     * @param string $lang
     * @return mixed
     */
    protected function dataMapping($items, string $lang): mixed
    {
        if ($items instanceof Course) {

            return [
                'id' => $items->id,
                'slug' => $items->slug,
                'name' => $items->getName->$lang,
                'content' => $items->getContent->$lang,
                'flip_box_content' => $items->getFlipBoxContent->$lang,
                'link' => $items->getLink->$lang,
                'icon' => config('adminlte.cdn_url') . $items->getMedia->$lang,
                'video' => config('adminlte.cdn_url') . $items->getMediaVideo->$lang,
                'programs' => $this->courseProgramService->getByData($items->getPrograms, $lang),
                'lessons' => $this->courseLessonService->getByCourseId($items->id, $lang)
            ];
        } else {
            return $items->map(function ($item) use ($lang) {
                return [
                    'id' => $item->id,
                    'slug' => $item->slug,
                    'name' => $item->getName->$lang,
                    'content' => $item->getContent->$lang,
                    'flip_box_content' => $item->getFlipBoxContent->$lang,
                    'link' => $item->getLink->$lang,
                    'icon' => config('adminlte.cdn_url') . $item->getMedia->$lang,
                    'video' => config('adminlte.cdn_url') . $item->getMediaVideo->$lang,
                    'programs' => $this->courseProgramService->getByData($item->getPrograms, $lang)
                ];
            });
        }

    }

}
