<?php

namespace App\Repositories;

use App\Models\Speakers;
use App\Repositories\Eloquent\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class SpeakersRepository extends BaseRepository
{
    public function __construct(Speakers $model,
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
     * @return array
     */
    public function getList(): array
    {
        $data = $this->model->query()->get();
        return $data->map(function ($item) {
            return [
                'value' => $item->id,
                'name' => $item->getName->ru,
            ];
        })->toArray();
    }

    /**
     * @param int $id
     * @return Collection|array
     */
    public function getByTypeAndId(int $id): Collection|array
    {
        return $this->model->query()
            ->with(['getName', 'getContent', 'getMedia'])
            ->where('id', $id)
            ->where('is_active', '1')
            ->get();
    }
}
