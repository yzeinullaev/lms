<?php

namespace App\Repositories;


use App\Models\Social;
use App\Repositories\Eloquent\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class SocialsRepository extends BaseRepository
{
    public function __construct(Social                   $model,
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
     * @param int $id
     * @return Collection|array
     */
    public function getByTypeAndId(int $id): Collection|array
    {
        return $this->model->query()
            ->with(['getMedia', 'getLink'])
            ->where('id', $id)
            ->where('is_active', '1')
            ->get();
    }

    /**
     * @return Collection|array
     */
    public function getByTypeAll(): Collection|array
    {
        return $this->model->query()
            ->with(['getMedia', 'getLink'])
            ->where('is_active', '1')
            ->get();
    }
}
