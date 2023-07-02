<?php

namespace App\Repositories;

use App\Models\MediaMultiLang;
use App\Repositories\Eloquent\BaseRepository;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class MediaMultiLangRepository extends BaseRepository
{
    /**
     * @param MediaMultiLang $model
     * @param LanguageRepository $languageRepository
     */
    public function __construct(MediaMultiLang $model,
                                LanguageRepository $languageRepository)
    {
        $this->languageRepository = $languageRepository;
        parent::__construct($model);
    }

    /**
     * @param Request $request
     * @param string $directoryName
     * @param string $key
     * @return mixed
     * @throws Throwable
     */
    public function storeMedia(Request $request, string $directoryName, string $key = 'images'): mixed
    {
        $langs = $this->languageRepository->getById();

        DB::beginTransaction();

        try {

            $modelData = [];

            foreach ($langs as $item) {
                if ($request->hasFile($key)) {
                    if (isset($request->file($key)[$item['slug']])) {
                        $modelData[$item['slug']] = $request->file($key)[$item['slug']]
                            ->store($directoryName, 'custom');
                    }
                }
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
     * @param Request $request
     * @param string $directoryName
     * @param string $key
     * @throws Throwable
     */
    public function updateMedia(Model $model, Request $request, string $directoryName, string $key = 'images')
    {
        $langs = $this->languageRepository->getById();

        DB::beginTransaction();

        try {

            $modelData = [];

            foreach ($langs as $item) {
                if ($request->hasFile($key)) {

                    if (isset($request->file($key)[$item['slug']])) {
                        $modelData[$item['slug']] = $request->file($key)[$item['slug']]
                            ->store($directoryName, 'custom');
                    }
                }
            }

            if ($model->$key) {
                $this->update($model->$key, $modelData);
            } else {
                throw new Exception('not Found Media ID');
            }

            DB::commit();

        } catch (Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }


    /**
     * @param Request $request
     * @param string $directoryName
     * @param string $key
     * @return mixed
     * @throws Throwable
     */
    public function storeMultiMedia(Request $request, string $directoryName, string $key = 'images'): mixed
    {
        $langs = $this->languageRepository->getById();

        DB::beginTransaction();

        try {

            $modelData = [];

            foreach ($langs as $item) {

                if ($request->has($key)) {
                    if (isset($request->file($key)[$item['slug']])) {
                        foreach ($request->file($key)[$item['slug']] as $file) {
                            $modelData[$item['slug']][] = $file
                                ->store($directoryName, 'custom');
                        }

                        $modelData[$item['slug']] = implode(',', $modelData[$item['slug']]);
                    }

                } else {
                    throw new Exception($key .' нет!');
                }
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
     * @param Request $request
     * @param string $directoryName
     * @param string $key
     * @return void
     * @throws Throwable
     */
    public function updateMultiMedia(Model $model, Request $request, string $directoryName, string $key = 'images'): void
    {
        $langs = $this->languageRepository->getById();

        DB::beginTransaction();

        try {

            $modelData = [];

            foreach ($langs as $item) {
                if ($request->has($key)) {
                    if (isset($request->file($key)[$item['slug']])) {

                        foreach ($request->file($key)[$item['slug']] as $file) {
                            $modelData[$item['slug']][] = $file
                                ->store($directoryName, 'custom');
                        }

                        $modelData[$item['slug']] = implode(',', $modelData[$item['slug']]);
                    }

                } else {
                    throw new Exception($key .' нет!');
                }
            }

            if ($model->$key) {
                $this->update($model->$key, $modelData);
            } else {
                throw new Exception('not Found Media ID');
            }

            DB::commit();

        } catch (Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}
