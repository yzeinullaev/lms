<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\CrudController;
use App\Repositories\LanguageRepository;
use App\Repositories\SubscriptionsRepository;
use App\Repositories\TranslateRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Throwable;

class SubscriptionsController extends CrudController
{
    /**
     * @param SubscriptionsRepository $repository
     * @param TranslateRepository $translateRepository
     * @param LanguageRepository $languageRepository
     */
    public function __construct(protected SubscriptionsRepository $repository,
                                protected TranslateRepository $translateRepository,
                                protected LanguageRepository $languageRepository)
    {
    }

    public function create(string $parentId = null): View|Factory|Application
    {
        $tariffs = $this->repository->getAllTariffs();
        $courses = $this->repository->getAllCourses();
        $users = $this->repository->getAllUsers();

        return parent::create($parentId)
            ->with('tariffs', $tariffs)
            ->with('courses', $courses)
            ->with('users', $users);
    }

    public function edit(string $id, string $parentId = null): View|Factory|Application
    {
        $tariffs = $this->repository->getAllTariffs();
        $courses = $this->repository->getAllCourses();
        $users = $this->repository->getAllUsers();

        return parent::edit($id, $parentId)
            ->with('tariffs', $tariffs)
            ->with('courses', $courses)
            ->with('users', $users);
    }

    public function update(Request $request, int $id): Redirector|RedirectResponse|Application
    {
        $requestData = $request->all();

        try {
            $this->repository->updatePayment($requestData);
            $this->repository->update($id, $this->cleanRequest($requestData, false));
            return redirect('admin/' . static::getSnakeName())->with('flash_message', 'Данные изменены!');

        } catch (Throwable $th) {
            return redirect('admin/' . static::getSnakeName())->with('error', $th->getMessage());
        }
    }

    public function store(Request $request): Redirector|RedirectResponse|Application
    {
        $requestData = $request->all();

        try {
            $requestData['payment_id'] = $this->repository->cretePayment($requestData);
            $this->repository->create($this->cleanRequest($requestData, false));

            return redirect('admin/' . static::getSnakeName())->with('flash_message', 'Успешно добавлена!');

        } catch (Throwable $th) {
            return redirect('admin/' . static::getSnakeName())->with('error', $th->getMessage());
        }
    }

    /**
     * @param $requestData
     * @param int $id
     * @throws Throwable
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
     * @throws Throwable
     */
    public function afterCreate(&$requestData)
    {
    }

    public function updateCleanRequest(&$requestData)
    {
    }

    public function creteCleanRequest(&$requestData)
    {
        unset($requestData['payment']);
    }
}
