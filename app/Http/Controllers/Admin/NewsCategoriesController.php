<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\CrudController;
use App\Repositories\LanguageRepository;
use App\Repositories\NewsCategoriesRepository;
use App\Repositories\TranslateRepository;

class NewsCategoriesController extends CrudController
{
    /**
     * @param NewsCategoriesRepository $repository
     * @param TranslateRepository $translateRepository
     * @param LanguageRepository $languageRepository
     */
    public function __construct(protected NewsCategoriesRepository $repository,
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
    }

    /**
     * @param $requestData
     * @throws \Throwable
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
