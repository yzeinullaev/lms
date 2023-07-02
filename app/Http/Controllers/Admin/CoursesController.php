<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\CrudController;
use App\Repositories\CourseRepository;
use App\Repositories\LanguageRepository;
use App\Repositories\TranslateRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Throwable;

class CoursesController extends CrudController
{
    /**
     * @param CourseRepository $repository
     * @param TranslateRepository $translateRepository
     * @param LanguageRepository $languageRepository
     */
    public function __construct(protected CourseRepository    $repository,
                                protected TranslateRepository $translateRepository,
                                protected LanguageRepository  $languageRepository)
    {
    }

    /**
     * @param Request $request
     * @return Redirector|RedirectResponse|Application
     */
    public function store(Request $request): Redirector|RedirectResponse|Application
    {
        $requestData = $request->all();

        try {

            $requestData['name'] = $this->translateRepository->storeTranslate($requestData);
            $requestData['content'] = $this->translateRepository->storeTranslate($requestData, 'content');
            $requestData['flip_box_content'] = $this->translateRepository->storeTranslate($requestData, 'flip_box_content');
            $requestData['url'] = $this->translateRepository->storeTranslate($requestData, 'url');
            $requestData['images'] = $this->repository->creteMultiMediaFiles($request, static::getSnakeName());

            if (empty($requestData['video'])) {
                $requestData['video'] = null;
            } else {
                $requestData['video'] = $this->repository->creteMultiMediaFiles($request, static::getSnakeName(), 'video');
            }

            $this->repository->create($this->cleanRequest($requestData, false));

            return redirect('admin/' . static::getSnakeName())->with('flash_message', 'Успешно добавлена!');

        } catch (Throwable $th) {
            return redirect('admin/' . static::getSnakeName())->with('error', $th->getMessage());
        }
    }

    /**
     * @param Request $request
     * @param int $id
     * @return Redirector|RedirectResponse|Application
     */
    public function update(Request $request, int $id): Redirector|RedirectResponse|Application
    {
        $requestData = $request->all();

        try {

            $this->translateRepository->updateTranslate($this->repository->findOrFail($id), $requestData);
            $this->translateRepository->updateTranslate($this->repository->findOrFail($id), $requestData, 'url');
            $this->translateRepository->updateTranslate($this->repository->findOrFail($id), $requestData, 'flip_box_content');
            $this->translateRepository->updateTranslate($this->repository->findOrFail($id), $requestData, 'content');
            $this->repository->updateMultiMediaFiles($id, $request, static::getSnakeName());


            if (!empty($requestData['video'])) {
                $this->repository->updateMultiMediaFiles($id, $request, static::getSnakeName(), 'video');
            }

            $this->repository->update($id, $this->cleanRequest($requestData));

            return redirect('admin/' . static::getSnakeName())->with('flash_message', 'Данные изменены!');

        } catch (Throwable $th) {
            return redirect('admin/' . static::getSnakeName())->with('error', $th->getMessage());
        }
    }

    public function beforeUpdate(&$requestData, int $id)
    {
    }

    public function afterUpdate(&$requestData, int $id)
    {
    }

    public function beforeCreate(&$requestData)
    {
    }

    public function afterCreate(&$requestData)
    {
    }

    public function updateCleanRequest(&$requestData)
    {
        unset($requestData['content']);
        unset($requestData['flip_box_content']);
        unset($requestData['url']);
        unset($requestData['images']);
        unset($requestData['video']);
    }

    public function creteCleanRequest(&$requestData)
    {
    }
}
