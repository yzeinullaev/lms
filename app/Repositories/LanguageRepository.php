<?php

namespace App\Repositories;

use App\Models\Language;
use App\Repositories\Eloquent\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LanguageRepository extends BaseRepository
{
    public function __construct(Language $model)
    {
        parent::__construct($model);
    }

    /**
     * @return mixed
     */
    public function getSlugById(): mixed
    {
        return $this->model->query()
            ->orderBy('id', 'ASC')
            ->pluck('slug')
            ->first();
    }

    /**
     * @param string $slug
     */
    public function creteNewSlug(string $slug)
    {
        Schema::table('translates', function (Blueprint $table) use ($slug) {
            $table->text($slug)->nullable();
        });

        Schema::table('media_multi_langs', function (Blueprint $table) use ($slug) {
            $table->text($slug)->nullable();
        });
    }

    /**
     * @param int $id
     * @return Collection|array
     */
    public function getByTypeAndId(int $id): Collection|array
    {
        return $this->model->query()
            ->where('id', $id)
            ->get();
    }

    /**
     * @return Collection|array
     */
    public function getByTypeAll(): Collection|array
    {
        return $this->model->query()
            ->get();
    }
}
