<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\CrudController;
use App\Repositories\CityRepository;
use App\Repositories\CountryRepository;
use App\Repositories\LanguageRepository;
use App\Repositories\TranslateRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class CitiesController extends CrudController
{
    /**
     * @param CityRepository $repository
     * @param TranslateRepository $translateRepository
     * @param CountryRepository $countryRepository
     * @param LanguageRepository $languageRepository
     */
    public function __construct(protected CityRepository      $repository,
                                protected TranslateRepository $translateRepository,
                                protected LanguageRepository  $languageRepository,
                                protected CountryRepository   $countryRepository)
    {
    }


    /**
     * @param string $id
     * @return Factory|View|Application
     */
    public function byCountry(string $id): Factory|View|Application
    {
        $cities = $this->repository->getByCountryId($id);
        return view('admin.cities.index', compact('cities'));
    }


    /**
     * @param string|null $parentId
     * @return View|Factory|Application
     */
    public function create(string $parentId = null): View|Factory|Application
    {
        $countries = $this->countryRepository->all();
        return view('admin.cities.create', compact('countries'));
    }


    /**
     * @param string $id
     * @param string|null $parentId
     * @return View|Factory|Application
     */
    public function edit(string $id, string $parentId = null): View|Factory|Application
    {
        $data = $this->repository->findOrFail($id);
        $countries = $this->countryRepository->all();

        return view('admin.cities.edit', compact('data', 'countries'));
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
    }

    public function creteCleanRequest(&$requestData)
    {
    }
}
