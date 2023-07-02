<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\CrudController;
use App\Repositories\LanguageRepository;
use App\Repositories\SocialsRepository;
use App\Repositories\TranslateRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Throwable;

class SocialsController extends CrudController
{
    /**
     * @param SocialsRepository $repository
     * @param TranslateRepository $translateRepository
     * @param LanguageRepository $languageRepository
     */
    public function __construct(protected SocialsRepository $repository,
                                protected TranslateRepository $translateRepository,
                                protected LanguageRepository $languageRepository)
    {
    }

    public function store(Request $request): Redirector|RedirectResponse|Application
    {
        $requestData = $request->all();

        try {
            $requestData['url'] = $this->translateRepository->storeTranslate($requestData, 'url');
            $requestData['images'] = $this->repository->creteMultiMediaFiles($request, static::getSnakeName());

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
            $this->translateRepository->updateTranslate($this->repository->findOrFail($id), $requestData, 'url');
            $this->repository->updateMultiMediaFiles($id, $request, static::getSnakeName());
            unset($requestData['url']);
            unset($requestData['images']);
            $this->repository->update($id, $this->cleanRequest($requestData, false));

            return redirect('admin/' . static::getSnakeName())->with('flash_message', 'Данные изменены!');

        } catch (Throwable $th) {
            return redirect('admin/' . static::getSnakeName())->with('error', $th->getMessage());
        }
    }

    /**
     * @param $requestData
     * @param int $id
     */
    public function beforeUpdate(&$requestData, int $id)
    {
    }

    /**
     * @param $requestData
     * @param int $id
     */
    public function afterUpdate(&$requestData, int $id)
    {
    }

    /**
     * @param $requestData
     */
    public function beforeCreate(&$requestData)
    {
    }

    /**
     * @param $requestData
     */
    public function afterCreate(&$requestData)
    {
    }

    /**
     * @param $requestData
     */
    public function updateCleanRequest(&$requestData)
    {
    }

    /**
     * @param $requestData
     */
    public function creteCleanRequest(&$requestData)
    {
    }
}
