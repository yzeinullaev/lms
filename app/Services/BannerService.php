<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\BannerRepository;

class BannerService
{
    /**
     * @param BannerRepository $repository
     */
    public function __construct(
        private BannerRepository $repository,
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
                'content' => $item->getContent->$lang,
                'link' => $item->getLink->$lang,
                'image' => config('adminlte.cdn_url') . $item->getMedia->$lang,
            ];
        });
    }

}
