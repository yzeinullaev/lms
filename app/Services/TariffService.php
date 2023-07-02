<?php

declare(strict_types=1);

namespace App\Services;


use App\Models\Tariff;
use App\Repositories\TariffsRepository;

class TariffService
{
    /**
     * @param TariffsRepository $repository
     * @param TariffItemService $tariffItemService
     */
    public function __construct(
        private TariffsRepository $repository,
        private TariffItemService $tariffItemService,
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
        if ($items instanceof Tariff) {
            return [
                'id' => $items->id,
                'name' => $items->getName->$lang,
                'content' => $items->getContent->$lang,
                'price' => $items->price,
                'discount' => $items->discount,
                'addition_price' => $items->addition_price,
                'buy_soon' => $items->soon,
                'block_item' => $this->tariffItemService->getByData($items->getTariffItems, $lang)
            ];
        } else {
            return $items->map(function ($item) use ($lang) {
                return [
                    'id' => $item->id,
                    'name' => $item->getName->$lang,
                    'content' => $item->getContent->$lang,
                    'price' => $item->price,
                    'discount' => $item->discount,
                    'addition_price' => $item->addition_price,
                    'buy_soon' => $item->soon,
                    'block_item' => $this->tariffItemService->getByData($item->getTariffItems, $lang)
                ];
            });
        }


    }

}
