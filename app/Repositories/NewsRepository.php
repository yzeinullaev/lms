<?php

namespace App\Repositories;

use App\Enums\ConstantEnum;
use App\Mail\SendMail;
use App\Models\News;
use App\Repositories\Eloquent\BaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class NewsRepository extends BaseRepository
{
    public function __construct(News                     $model,
                                MediaMultiLangRepository $mediaMultiLangRepository,
                                UserRepository           $userRepository,
    )
    {
        $this->mediaMultiLangRepository = $mediaMultiLangRepository;
        $this->userRepository = $userRepository;
        parent::__construct($model);
    }

    /**
     * @param $id
     * @param Request $request
     * @param string $directoryName
     * @param string $key
     * @return void
     * @throws \Throwable
     */
    public function updateMultiMediaFiles($id, Request $request, string $directoryName, string $key = 'images'): void
    {
        $this->mediaMultiLangRepository->updateMedia($this->findOrFail($id), $request, $directoryName, $key);
    }

    /**
     * @param Request $request
     * @param string $directoryName
     * @param string $key
     * @return mixed
     * @throws \Throwable
     */
    public function creteMultiMediaFiles(Request $request, string $directoryName, string $key = 'images'): mixed
    {
        return $this->mediaMultiLangRepository->storeMedia($request, $directoryName, $key);
    }

    /**
     * @param $parentId
     * @return LengthAwarePaginator
     */
    public function getLatestPaginateByParentId($parentId): LengthAwarePaginator
    {
        return $this->model->query()
            ->where('news_category_id', $parentId)
            ->latest()
            ->paginate(ConstantEnum::DEFAULT_PAGINATE);
    }

    /**
     * @param int $id
     * @param string $slug
     * @return Collection|array
     */
    public function getByIdAndSlug(int $id, string $slug): Collection|array
    {
        return $this->model->query()
            ->with(['getName', 'getContent', 'getNewsCategory', 'getMedia'])
            ->when($id, function ($query) use ($id) {
                if ($id) {
                    $query->where('id', $id);
                }
                return $query;
            })
            ->when($slug, function ($query) use ($slug) {
                if ($slug) {
                    $query->where('slug', $slug);

                }
                return $query;
            })
            ->get();
    }

    /**
     * @return Collection|array
     */
    public function getRecommendedNews(): Collection|array
    {
        return $this->model->query()
            ->with(['getName', 'getContent', 'getNewsCategory', 'getMedia'])
            ->orderBy('date', 'DESC')
            ->limit(4)
            ->get();
    }

    /**
     * @return Collection|array
     */
    public function getByPublicationToday(): Collection|array
    {
        return $this->model->query()
            ->with(['getName', 'getContent', 'getNewsCategory', 'getMedia'])
            ->whereDate('date', now()->format('Y-m-d'))
            ->get();
    }
}
