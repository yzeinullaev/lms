<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\CrudController;
use App\Repositories\ApplicationRepository;
use App\Repositories\LanguageRepository;
use App\Repositories\TranslateRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Throwable;

class ApplicationsController extends CrudController
{
    /**
     * @param ApplicationRepository $repository
     * @param TranslateRepository $translateRepository
     * @param LanguageRepository $languageRepository
     */
    public function __construct(protected ApplicationRepository $repository,
                                protected TranslateRepository $translateRepository,
                                protected LanguageRepository $languageRepository)
    {
    }

    /**
     * @param string $id
     * @param string|null $parentId
     * @return View|Factory|Application
     */
    public function edit(string $id, string $parentId = null): View|Factory|Application
    {
        $courses = $this->repository->getAllCourses();
        return parent::edit($id, $parentId)->with('courses', $courses);
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
