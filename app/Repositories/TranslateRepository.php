<?php

namespace App\Repositories;

use App\Models\Translate;
use App\Repositories\Eloquent\BaseRepository;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Throwable;

class TranslateRepository extends BaseRepository
{
    /**
     * @param Translate $model
     * @param LanguageRepository $languageRepository
     */
    public function __construct(Translate $model,
                                LanguageRepository $languageRepository)
    {
        $this->languageRepository = $languageRepository;
        parent::__construct($model);
    }

    /**
     * @param array $data
     * @param string $key
     * @return mixed
     * @throws Throwable
     */
    public function storeTranslate(array $data, string $key = 'name'): mixed
    {
        $langs = $this->languageRepository->getById();

        DB::beginTransaction();

        try {

            $modelData = [];

            foreach ($langs as $item) {

                $currentLang = $item['slug'];
                $modelData[$currentLang] = $data[$key][$currentLang];
            }

            $afterCreate = $this->create($modelData);

            DB::commit();

            return $afterCreate->id;

        } catch (Throwable $th) {

            DB::rollBack();
            throw $th;
        }
    }


    /**
     * @param Model $model
     * @param array $data
     * @param string $key
     * @return void
     * @throws Throwable
     */
    public function updateTranslate(Model $model, array $data, string $key = 'name'): void
    {

        $langs = $this->languageRepository->getById();

        DB::beginTransaction();

        try {

            $modelData = [];

            foreach ($langs as $item) {
                $currentLang = $item['slug'];
                $modelData[$currentLang] = $data[$key][$currentLang];
            }

            if ($model->$key) {
                $this->update($model->$key, $modelData);
            } else {
                throw new Exception('not Found Translate ID');
            }

            DB::commit();

        } catch (Throwable $th) {

            DB::rollBack();
            throw $th;
        }
    }
}
