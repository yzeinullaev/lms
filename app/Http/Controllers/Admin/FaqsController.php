<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\CrudController;
use App\Repositories\FaqsRepository;
use App\Repositories\LanguageRepository;
use App\Repositories\TranslateRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Throwable;

class FaqsController extends CrudController
{
    /**
     * @param FaqsRepository $repository
     * @param TranslateRepository $translateRepository
     * @param LanguageRepository $languageRepository
     */
    public function __construct(protected FaqsRepository $repository,
                                protected TranslateRepository $translateRepository,
                                protected LanguageRepository $languageRepository)
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

            $requestData['question'] = $this->translateRepository->storeTranslate($requestData, 'question');
            $requestData['answer'] = $this->translateRepository->storeTranslate($requestData, 'answer');
            $requestData['meta_title'] = $this->translateRepository->storeTranslate($requestData, 'meta_title');
            $requestData['meta_description'] = $this->translateRepository->storeTranslate($requestData, 'meta_description');
            $requestData['meta_keywords'] = $this->translateRepository->storeTranslate($requestData, 'meta_keywords');

            $this->repository->create($this->cleanRequest($requestData, false));

            return redirect('admin/' . static::getSnakeName())->with('flash_message', 'Успешно добавлена!');

        } catch (Throwable $th) {
            return redirect('admin/' . static::getSnakeName())->with('error', $th->getMessage());
        }
    }

    public function update(Request $request, int $id): Redirector|RedirectResponse|Application
    {
        $requestData = $request->all();

        try {
            $this->translateRepository->updateTranslate($this->repository->findOrFail($id), $requestData, 'question');
            $this->translateRepository->updateTranslate($this->repository->findOrFail($id), $requestData, 'answer');
            $this->translateRepository->updateTranslate($this->repository->findOrFail($id), $requestData, 'meta_title');
            $this->translateRepository->updateTranslate($this->repository->findOrFail($id), $requestData, 'meta_description');
            $this->translateRepository->updateTranslate($this->repository->findOrFail($id), $requestData, 'meta_keywords');

            $this->repository->update($id, $this->cleanRequest($requestData));

            return redirect('admin/' . static::getSnakeName())->with('flash_message', 'Данные изменены!');

        } catch (Throwable $th) {
            return redirect('admin/' . static::getSnakeName())->with('error', $th->getMessage());
        }
    }

    /**
     * @param $requestData
     * @param $id
     */
    public function afterUpdate(&$requestData, $id)
    {
    }

    /**
     * @param $requestData
     * @param $id
     * @throws Throwable
     */
    public function beforeUpdate(&$requestData, $id)
    {
    }

    /**
     * @param $requestData
     * @throws Throwable
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
        unset($requestData['question']);
        unset($requestData['answer']);
        unset($requestData['meta_title']);
        unset($requestData['meta_description']);
        unset($requestData['meta_keywords']);
    }

    /**
     * @param $requestData
     */
    public function creteCleanRequest(&$requestData)
    {
    }
}
