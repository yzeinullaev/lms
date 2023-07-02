<?php

declare(strict_types=1);

namespace App\Services;


use App\Repositories\FaqsRepository;

class FaqService
{
    /**
     * @param FaqsRepository $repository
     */
    public function __construct(
        private FaqsRepository $repository,
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
                'question' => $item->getQuestion->$lang,
                'answer' => $item->getAnswer->$lang,
                'mete_title' => $item->getMetaTitle->$lang,
                'mete_description' => $item->getMetaDescription->$lang,
                'mete_keywords' => $item->getMetaKeywords->$lang,
            ];
        });
    }

}
