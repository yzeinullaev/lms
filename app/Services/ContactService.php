<?php

declare(strict_types=1);

namespace App\Services;


use App\Repositories\ContactsRepository;

class ContactService
{
    /**
     * @param ContactsRepository $repository
     */
    public function __construct(
        private ContactsRepository $repository,
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
                'phone' => $item->phone,
                'address' => $item->address,
                'email' => $item->email,
                'map_url' => $item->map_url,
            ];
        });
    }

}
