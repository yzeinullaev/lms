<?php

declare(strict_types=1);

namespace App\Services;


use App\Enums\ConstantEnum;
use App\Repositories\SubscriptionsRepository;


class SubscriptionService
{
    /**
     * @param SubscriptionsRepository $repository
     * @param CourseService $courseService
     * @param TariffService $tariffService
     */
    public function __construct(private SubscriptionsRepository $repository,
                                private CourseService $courseService,
                                private TariffService $tariffService,
    )
    {
    }

    /**
     * @param int $userId
     * @param string $lang
     * @return mixed
     */
    public function getByUserId(int $userId, string $lang = ConstantEnum::DEFAULT_LANG): mixed
    {
        return self::dataMapping($this->repository->getByUserId($userId), $lang);
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
                'course_id' => $item->course_id,
                'tariff_id' => $item->tariff_id,
                'user_id' => $item->user_id,
                'payment_id' => $item->payment_id,
                'payment_status' => $item->payment_status,
                'start_subscribe' => $item->start_subscribe,
                'end_subscribe' => $item->end_subscribe,
                'course' => $this->courseService->getByData($item->getCourse, $lang),
                'tariff' => $this->tariffService->getByData($item->getTariff, $lang),
            ];
        });
    }

}
