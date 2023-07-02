<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\NotificationRepository;
use Carbon\Carbon;

class NotificationService
{
    /**
     * @param NotificationRepository $repository
     */
    public function __construct(private NotificationRepository $repository)
    {
    }

    /**
     * @param int $userId
     * @param string $lang
     * @return mixed
     */
    public function getByUserId(int $userId, string $lang): mixed
    {
        return self::dataMapping($this->repository->getByUserId($userId), $lang);
    }

    public function getAll(string $lang): mixed
    {
        return self::dataMapping($this->repository->getAll(), $lang);
    }

    /**
     * @param $items
     * @param $lang
     * @return mixed
     */
    protected function dataMapping($items, $lang): mixed
    {
        return $items->map(function ($item) use ($lang) {
            return [
                'id' => $item->id,
                'name' => $item->getName->$lang,
                'content' => $item->getContent->$lang,
                'date' => Carbon::parse($item->updated_at)->format('d.m.Y'),
                'time' => Carbon::parse($item->updated_at)->format('h:i:s'),
            ];
        });
    }
}
