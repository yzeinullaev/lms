<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\CrudController;
use App\Repositories\LanguageRepository;
use App\Repositories\ReviewsRepository;
use App\Repositories\TranslateRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Throwable;

class ReviewsController extends CrudController
{
    /**
     * @param ReviewsRepository $repository
     * @param TranslateRepository $translateRepository
     * @param LanguageRepository $languageRepository
     */
    public function __construct(protected ReviewsRepository   $repository,
                                protected TranslateRepository $translateRepository,
                                protected LanguageRepository  $languageRepository)
    {
    }

    /**
     * @param string|null $parentId
     * @return View|Factory|Application
     */
    public function create(string $parentId = null): View|Factory|Application
    {
        $users = $this->repository->getUsers();
        $courses = $this->repository->getCourses();

        return parent::create($parentId)->with('users', $users)->with('courses', $courses);
    }

    /**
     * @param Request $request
     * @return Redirector|RedirectResponse|Application
     */
    public function store(Request $request): Redirector|RedirectResponse|Application
    {
        $requestData = $request->all();

        try {

            $this->repository->create($this->cleanRequest($requestData, false));

            return redirect('admin/' . static::getSnakeName())->with('flash_message', 'Успешно добавлена!');

        } catch (Throwable $th) {
            return redirect('admin/' . static::getSnakeName())->with('error', $th->getMessage());
        }
    }

    /**
     * @param string $id
     * @param string|null $parentId
     * @return View|Factory|Application
     */
    public function edit(string $id, string $parentId = null): View|Factory|Application
    {
        $users = $this->repository->getUsers();
        $courses = $this->repository->getCourses();
        return parent::edit($id, $parentId)->with('users', $users)->with('courses', $courses);
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
