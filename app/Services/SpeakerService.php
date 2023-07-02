<?php

declare(strict_types=1);

namespace App\Services;


use App\Repositories\SpeakersRepository;

class SpeakerService
{
    /**
     * @param SpeakersRepository $repository
     */
    public function __construct(
        private SpeakersRepository $repository,
    ) {
    }

    public function getById(int $id, string $lang)
    {
        return self::dataMapping($this->repository->getByTypeAndId($id), $lang);
    }

    /**
     * @param $items
     * @param string $lang
     * @return mixed
     */
    protected function dataMapping($items, string $lang): mixed
    {
        return $items->map(function ($item) use ($lang) {
            return [
                'id' => $item->id,
                'name' => $item->getName->$lang,
                'content' => $item->getContent->$lang,
                'image' => config('adminlte.cdn_url') . $item->getMedia->$lang,
            ];
        });
    }

}
