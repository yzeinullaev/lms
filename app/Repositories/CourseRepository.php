<?php

namespace App\Repositories;

use App\Enums\ConstantEnum;
use App\Models\Course;
use App\Repositories\Eloquent\BaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class CourseRepository extends BaseRepository
{
    public function __construct(Course                   $model,
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
     * @param $childSlug
     * @return Collection|array
     */
    public function getByTypeAndId(int $id, $childSlug = null): Collection|array
    {
        $query = $this->model->query()
            ->with(['getName', 'getContent', 'getFlipBoxContent', 'getLink', 'getMedia', 'getMediaVideo'])
            ->with('getPrograms', function ($query) {
                $query->where('is_active', '1');
            })
            ->where('id', $id)
            ->where('is_active', '1');

        if ($childSlug) {
            $query->where('slug', $childSlug);
        }

        return $query->get();
    }

    /**
     * @param $childSlug
     * @return Collection|array
     */
    public function getByTypeAll($childSlug = null): Collection|array
    {
        $query = $this->model->query()
            ->with(['getName', 'getContent', 'getFlipBoxContent', 'getLink', 'getMedia', 'getMediaVideo'])
            ->with('getPrograms', function ($query) {
                $query->where('is_active', '1');
            })
            ->where('is_active', '1');

        if ($childSlug) {
            $query->where('slug', $childSlug);
        }

        return $query->get();
    }
}
