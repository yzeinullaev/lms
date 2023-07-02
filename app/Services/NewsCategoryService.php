<?php

declare(strict_types=1);

namespace App\Services;


use App\Repositories\NewsCategoriesRepository;

class NewsCategoryService
{
    /**
     * @param NewsCategoriesRepository $repository
     * @param NewsService $newsService
     */
    public function __construct(
        private NewsCategoriesRepository $repository,
        private NewsService $newsService,
    ) {
    }

    public function getById(int $id, string $lang, $childSlug)
    {
        if ($id === 0) {
            return self::dataMapping($this->repository->getByTypeAll($childSlug), $lang);
        }

        return self::dataMapping($this->repository->getByTypeAndId($id, $childSlug), $lang);
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
                'category' => $item->getName->$lang,
                'news' => $this->newsService->getByData($item->getNews, $lang)
            ];
        });
    }

}
