<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\CrudController;
use App\Repositories\ErrorCodeRepository;
use App\Repositories\LanguageRepository;
use App\Repositories\TranslateRepository;

class ErrorCodesController extends CrudController
{
    /**
     * @param ErrorCodeRepository $repository
     * @param TranslateRepository $translateRepository
     * @param LanguageRepository $languageRepository
     */
    public function __construct(protected ErrorCodeRepository $repository,
                                protected TranslateRepository $translateRepository,
                                protected LanguageRepository $languageRepository)
    {
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
