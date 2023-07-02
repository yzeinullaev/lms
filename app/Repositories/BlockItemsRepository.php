<?php

namespace App\Repositories;

use App\Enums\ConstantEnum;
use App\Models\BlockItem;
use App\Repositories\Eloquent\BaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class BlockItemsRepository extends BaseRepository
{
    public function __construct(BlockItem                $model,
                                MediaMultiLangRepository $mediaMultiLangRepository)
    {
        $this->mediaMultiLangRepository = $mediaMultiLangRepository;
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
    public function updateMultiMediaFiles($id, Request $request, string $directoryName, string $key = 'icon'): void
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
    public function creteMultiMediaFiles(Request $request, string $directoryName, string $key = 'icon'): mixed
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
            ->where('block_id', $parentId)
            ->latest()
            ->paginate(ConstantEnum::DEFAULT_PAGINATE);
    }
}
