<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\CrudController;
use App\Repositories\CountryRepository;
use App\Repositories\LanguageRepository;
use App\Repositories\TranslateRepository;


class CountriesController extends CrudController
{
    /**
     * @param CountryRepository $repository
     * @param TranslateRepository $translateRepository
     * @param LanguageRepository $languageRepository
     */
    public function __construct(protected CountryRepository $repository,
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
     */
    public function beforeUpdate(&$requestData, $id)
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
