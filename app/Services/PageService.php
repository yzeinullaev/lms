<?php

declare(strict_types=1);

namespace App\Services;


use App\Repositories\PagesRepository;
use Illuminate\Database\Eloquent\Collection;

class PageService
{
    /**
     * @param PagesRepository $repository
     * @param PageItemService $pageItemService
     */
    public function __construct(
        private PagesRepository $repository,
        private PageItemService $pageItemService,
    ) {
    }

    /**
     * @param null $slug
     * @param $childSlug
     * @param string $lang
     * @return Collection|array
     */
    public function getPageBySlug($slug, $childSlug, string $lang): Collection|array
    {
        $page = $this->repository->getPageWithItems($slug);

        return [
            'title' => $page['get_name'][$lang],
            'blocks' => $this->pageItemService->getPageItemsMap(collect($page['get_page_items']), $childSlug, $lang)
        ];
    }

}
