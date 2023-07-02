<?php

declare(strict_types=1);

namespace App\Services;


use App\Enums\ConstantEnum;
use App\Repositories\NewsRepository;
use Illuminate\Database\Eloquent\Collection;

class NewsService
{
    /**
     * @param NewsRepository $repository
     */
    public function __construct(
        private NewsRepository $repository,
    ) {
    }

    /**
     * @param int $id
     * @param string $lang
     * @param $slug
     */
    public function getById(int $id, string $lang, $slug = null)
    {
        return self::dataMapping($this->repository->getByIdAndSlug($id, $slug), $lang)
            ->merge(['recommended_news' => self::dataMapping($this->repository->getRecommendedNews(), $lang)]);
    }

    /**
     * @return mixed
     */
    public function getByPublicationDate(): mixed
    {
        return self::dataMapping($this->repository->getByPublicationToday(), ConstantEnum::DEFAULT_LANG);
    }

    /**
     * @param Collection $data
     * @param string $lang
     * @return mixed
     */
    public function getByData(Collection $data, string $lang): mixed
    {
        return self::dataMapping(collect($data), $lang);
    }

    /**
     * @param string $lang
     * @return mixed
     */
    public function getRecommendedNews(string $lang): mixed
    {
        return self::dataMapping($this->repository->getRecommendedNews(), $lang);
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
                'slug' => $item->slug,
                'name' => $item->getName->$lang,
                'content' => $item->getContent->$lang,
                'image' => config('adminlte.cdn_url') . $item->getMedia->$lang,
                'date' => $item->date
            ];
        });
    }

}
