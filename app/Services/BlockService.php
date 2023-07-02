<?php

declare(strict_types=1);

namespace App\Services;


use App\Repositories\BlocksRepository;

class BlockService
{
    /**
     * @param BlocksRepository $repository
     * @param BlockItemService $blockItemService
     */
    public function __construct(
        private BlocksRepository $repository,
        private BlockItemService $blockItemService,
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
                'block_item' => $this->blockItemService->getByData($item->getBlockItems, $lang)
            ];
        });
    }

}
