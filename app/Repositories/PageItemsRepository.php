<?php

namespace App\Repositories;

use App\Enums\ConstantEnum;
use App\Enums\PageTypeEnum;
use App\Models\PageItem;
use App\Repositories\Eloquent\BaseRepository;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class PageItemsRepository extends BaseRepository
{
    public function __construct(PageItem                     $model,
                                BannerRepository             $bannerRepository,
                                BlocksRepository             $blocksRepository,
                                ContactsRepository           $contactsRepository,
                                CourseRepository             $courseRepository,
                                DisclaimersRepository        $disclaimersRepository,
                                FaqsRepository               $faqsRepository,
                                NewsRepository               $newsRepository,
                                ReviewsRepository            $reviewsRepository,
                                SocialsRepository            $socialsRepository,
                                SpeakersRepository           $speakersRepository,
                                TariffsRepository            $tariffsRepository,
                                TermsAndConditionsRepository $termsAndConditionsRepository,
                                UserRepository               $userRepository)
    {
        $this->bannerRepository = $bannerRepository;
        $this->blocksRepository = $blocksRepository;
        $this->contactsRepository = $contactsRepository;
        $this->courseRepository = $courseRepository;
        $this->disclaimersRepository = $disclaimersRepository;
        $this->faqsRepository = $faqsRepository;
        $this->newsRepository = $newsRepository;
        $this->reviewsRepository = $reviewsRepository;
        $this->socialsRepository = $socialsRepository;
        $this->speakersRepository = $speakersRepository;
        $this->tariffsRepository = $tariffsRepository;
        $this->termsAndConditionsRepository = $termsAndConditionsRepository;
        $this->userRepository = $userRepository;
        parent::__construct($model);
    }

    /**
     * @param $parentId
     * @return LengthAwarePaginator
     */
    public function getLatestPaginateByParentId($parentId): LengthAwarePaginator
    {
        return $this->model->query()
            ->where('page_id', $parentId)
            ->latest()
            ->paginate(ConstantEnum::DEFAULT_PAGINATE);
    }

    /**
     * @throws Exception
     */
    public function storeByPageType(string $pageType): array
    {
        return match ($pageType) {
            PageTypeEnum::BANNERS => $this->bannerRepository->getList(),
            PageTypeEnum::BLOCKS => $this->blocksRepository->getList(),
            PageTypeEnum::CONTACTS => $this->contactsRepository->getList(),
            PageTypeEnum::SPEAKERS => $this->speakersRepository->getList(),
            PageTypeEnum::DISCLAIMERS => $this->disclaimersRepository->getList(),
            default => throw new Exception('Не найден тип страницы!', 500),
        };
    }


}
