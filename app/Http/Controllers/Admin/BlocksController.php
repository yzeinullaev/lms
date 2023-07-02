<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\CrudController;
use App\Repositories\BlocksRepository;
use App\Repositories\LanguageRepository;
use App\Repositories\TranslateRepository;

class BlocksController extends CrudController
{
    /**
     * @param BlocksRepository $repository
     * @param TranslateRepository $translateRepository
     * @param LanguageRepository $languageRepository
     */
    public function __construct(protected BlocksRepository $repository,
                                protected TranslateRepository $translateRepository,
                                protected LanguageRepository $languageRepository)
    {
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
     * @throws \Throwable
     */
    public function beforeUpdate(&$requestData, $id)
    {
        $this->translateRepository->updateTranslate($this->repository->findOrFail($id), $requestData, 'content');
    }

    /**
     * @param $requestData
     * @throws \Throwable
     */
    public function beforeCreate(&$requestData)
    {
        $requestData['content'] = $this->translateRepository->storeTranslate($requestData, 'content');
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
        unset($requestData['content']);
    }

    /**
     * @param $requestData
     */
    public function creteCleanRequest(&$requestData)
    {
    }
}
