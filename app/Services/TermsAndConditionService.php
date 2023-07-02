<?php

declare(strict_types=1);

namespace App\Services;


use App\Repositories\TermsAndConditionsRepository;

class TermsAndConditionService
{
    /**
     * @param TermsAndConditionsRepository $repository
     */
    public function __construct(
        private TermsAndConditionsRepository $repository,
    ) {
    }

    public function getById(int $id, string $lang)
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
                'name' => $item->getName->$lang,
                'content' => $item->getContent->$lang,
                'file' => config('adminlte.cdn_url') . $item->getMedia->$lang,
            ];
        });
    }

}
