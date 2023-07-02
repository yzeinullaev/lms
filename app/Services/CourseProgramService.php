<?php

declare(strict_types=1);

namespace App\Services;


use App\Repositories\CourseProgramRepository;
use Illuminate\Database\Eloquent\Collection;

class CourseProgramService
{
    /**
     * @param CourseProgramRepository $repository
     */
    public function __construct(
        private CourseProgramRepository $repository,
    ) {
    }

    /**
     * @param Collection $data
     * @param string $lang
     * @return mixed
     */
    public function getByData(Collection $data, string $lang): mixed
    {
        return self::dataMapping(collect($data), $lang);
    }

    /**
     * @param $items
     * @param string $lang
     * @return mixed
     */
    protected function dataMapping($items, string $lang = 'ru'): mixed
    {
        return $items->map(function ($item) use ($lang) {
            return [
                'id' => $item->id,
                'name' => $item->getName->$lang,
                'content' => $item->getContent->$lang,
            ];
        })->toArray();
    }

}
