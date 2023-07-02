<?php

declare(strict_types=1);

namespace App\Services;


use App\Repositories\SocialsRepository;

class SocialService
{
    /**
     * @param SocialsRepository $repository
     */
    public function __construct(
        private SocialsRepository $repository,
    ) {
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
     * @param $items
     * @param string $lang
     * @return mixed
     */
    protected function dataMapping($items, string $lang): mixed
    {
        return $items->map(function ($item) use ($lang) {
            return [
                'id' => $item->id,
                'name' => $item->name,
                'icon' => config('adminlte.cdn_url') . $item->getMedia->$lang,
                'link' => $item->getLink->$lang
            ];
        });
    }

}
