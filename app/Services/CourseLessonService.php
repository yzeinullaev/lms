<?php

declare(strict_types=1);

namespace App\Services;


use App\Repositories\CourseLessonsRepository;

class CourseLessonService
{
    /**
     * @param CourseLessonsRepository $repository
     */
    public function __construct(
        private CourseLessonsRepository $repository,
    ) {
    }

    public function getByCourseId(int $courseId, string $lang)
    {
        return self::dataMapping($this->repository->getByCourseId($courseId), $lang);
    }

    /**
     * @param $items
     * @param string $lang
     * @return mixed
     */
    protected function dataMapping($items, string $lang = 'ru'): mixed
    {
        return $items->map(function ($item) use ($lang) {

            $url = config('adminlte.cdn_url');
            $files = explode(',', $item->getFile->$lang);

            return [
                'id' => $item->id,
                'name' => $item->getName->$lang,
                'content' => $item->getContent->$lang,
                'file' => collect($files)->map(function ($file) use ($url) {
                    return $url . $file;
                }),
                'video' => config('adminlte.cdn_url') . $item->getMediaVideo->$lang,
            ];
        })->toArray();
    }

}
