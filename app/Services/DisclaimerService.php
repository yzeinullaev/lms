<?php

declare(strict_types=1);

namespace App\Services;


use App\Repositories\DisclaimersRepository;

class DisclaimerService
{
    /**
     * @param DisclaimersRepository $repository
     */
    public function __construct(
        private DisclaimersRepository $repository,
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
                'content' => $item->getContent->$lang
            ];
        });
    }

}
