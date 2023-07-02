<?php

declare(strict_types=1);

namespace App\Services;


use App\Repositories\TariffItemsRepository;
use Illuminate\Database\Eloquent\Collection;

class TariffItemService
{
    /**
     * @param TariffItemsRepository $repository
     */
    public function __construct(
        private TariffItemsRepository $repository,
    ) {
    }

    public function getByData(Collection $data, string $lang)
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
                'content' => $item->getContent->$lang,
                'icon' => config('adminlte.cdn_url') . $item->getMedia->$lang,
            ];
        })->toArray();
    }



}
