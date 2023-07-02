<?php

declare(strict_types=1);

namespace App\Services;


use App\Enums\PageTypeEnum;
use App\Repositories\PageItemsRepository;
use App\Repositories\PagesRepository;
use Exception;
use Illuminate\Support\Collection;

class PageItemService
{
    /**
     * @param PageItemsRepository $repository
     * @param BannerService $bannerService
     * @param BlockService $blockService
     * @param ContactService $contactService
     * @param SpeakerService $speakerService
     * @param DisclaimerService $disclaimerService
     * @param CourseService $courseService
     * @param FaqService $faqService
     * @param NewsCategoryService $newsCategoryService
     * @param ReviewService $reviewService
     * @param SocialService $socialService
     * @param TariffService $tariffService
     * @param TermsAndConditionService $termsAndConditionService
     * @param UserService $userService
     * @param LanguageService $languageService
     * @param PagesRepository $pagesRepository
     * @param NewsService $newsService
     */
    public function __construct(
        private PageItemsRepository $repository,
        private BannerService $bannerService,
        private BlockService $blockService,
        private ContactService $contactService,
        private SpeakerService $speakerService,
        private DisclaimerService $disclaimerService,
        private CourseService $courseService,
        private FaqService $faqService,
        private NewsCategoryService $newsCategoryService,
        private ReviewService $reviewService,
        private SocialService $socialService,
        private TariffService $tariffService,
        private TermsAndConditionService $termsAndConditionService,
        private UserService $userService,
        private LanguageService $languageService,
        private PagesRepository $pagesRepository,
        private NewsService $newsService,
    ) {
    }

    /**
     * @param Collection $pageItems
     * @param $childSlug
     * @param $lang
     * @return array
     */
    public function getPageItemsMap(Collection $pageItems, $childSlug, $lang): array
    {
        return $pageItems->map(function ($item) use ($lang, $childSlug) {
            return [
                'id' => $item['id'],
                'item_type' => $item['item_type'],
                'item_type_name' => PageTypeEnum::TYPES[$item['item_type']],
                'item_type_data' => self::getMappingItemData($item['item_type'], $item['item_type_id'], $childSlug, $lang),
            ];
        })->toArray();
    }

    /**
     * @param $type
     * @param $id
     * @param $childSlug
     * @param $lang
     * @return mixed
     * @throws Exception
     */
    protected function getMappingItemData($type, $id, $childSlug, $lang): mixed
    {
        return $this->getItemByPageTypeAndId($type, $id, $childSlug, $lang)->map(function ($item) {
            return $item;
        })->toArray();
    }

    /**
     * @throws Exception
     */
    public function getItemByPageTypeAndId(string $pageType, int $typeId, $childSlug, string $lang): mixed
    {
        return match ($pageType) {
            PageTypeEnum::BANNERS => $this->bannerService->getById($typeId, $lang),
            PageTypeEnum::BLOCKS => $this->blockService->getById($typeId, $lang),
            PageTypeEnum::CONTACTS => $this->contactService->getById($typeId, $lang),
            PageTypeEnum::SPEAKERS => $this->speakerService->getById($typeId, $lang),
            PageTypeEnum::DISCLAIMERS => $this->disclaimerService->getById($typeId, $lang),
            PageTypeEnum::COURSES => $this->courseService->getById($typeId, $lang, $childSlug),
            PageTypeEnum::FAQ => $this->faqService->getById($typeId, $lang),
            PageTypeEnum::NEWS => $childSlug ?
                                    $this->newsService->getById($typeId, $lang, $childSlug) :
                                    $this->newsCategoryService->getById($typeId, $lang, $childSlug),
            PageTypeEnum::REVIEWS => $this->reviewService->getById($typeId, $lang),
            PageTypeEnum::SOCIALS => $this->socialService->getById($typeId, $lang),
            PageTypeEnum::TARIFFS => $this->tariffService->getById($typeId, $lang),
            PageTypeEnum::TERMS => $this->termsAndConditionService->getById($typeId, $lang),
            PageTypeEnum::USERS => $this->userService->getById($typeId, $lang),
            PageTypeEnum::LANGUAGES => $this->languageService->getById($typeId, $lang),
            PageTypeEnum::MENU => $this->getByLang($lang),
            PageTypeEnum::RECOMMENDED_NEWS => $this->newsService->getRecommendedNews($lang),
            default => throw new Exception('Не найден тип страницы!', 500),
        };
    }

    /**
     * @param string $lang
     * @return mixed
     */
    public function getByLang(string $lang): mixed
    {
        return self::dataMapping($this->pagesRepository->getMenu(), $lang);
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
                'slug' => $item->slug
            ];
        });
    }

}
