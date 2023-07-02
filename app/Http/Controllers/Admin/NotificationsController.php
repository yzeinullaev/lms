<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\CrudController;
use App\Repositories\LanguageRepository;
use App\Repositories\NotificationRepository;
use App\Repositories\TranslateRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Throwable;

class NotificationsController extends CrudController
{
    /**
     * @param NotificationRepository $repository
     * @param TranslateRepository $translateRepository
     * @param LanguageRepository $languageRepository
     */
    public function __construct(protected NotificationRepository   $repository,
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
        $users = $this->repository->getAllUsers();
        return parent::create($parentId)->with('users', $users);
    }

    /**
     * @param string $id
     * @param string|null $parentId
     * @return View|Factory|Application
     */
    public function edit(string $id, string $parentId = null): View|Factory|Application
    {
        $users = $this->repository->getAllUsers();
        return parent::edit($id, $parentId)->with('users', $users);
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
            $this->translateRepository->updateTranslate($this->repository->findOrFail($id), $requestData);
            $this->translateRepository->updateTranslate($this->repository->findOrFail($id), $requestData, 'content');
            $requestData['user_type'] = $requestData['user_id'] != 0 ?? 0;
            $this->repository->update($id, $this->cleanRequest($requestData));

            return redirect('admin/' . static::getSnakeName())->with('flash_message', 'Данные изменены!');

        } catch (Throwable $th) {
            return redirect('admin/' . static::getSnakeName())->with('error', $th->getMessage());
        }
    }

    /**
     * @param Request $request
     * @return Redirector|RedirectResponse|Application
     */
    public function store(Request $request): Redirector|RedirectResponse|Application
    {
        $requestData = $request->all();

        try {
            $requestData['name'] = $this->translateRepository->storeTranslate($requestData);
            $requestData['content'] = $this->translateRepository->storeTranslate($requestData, 'content');
            $requestData['user_type'] = $requestData['user_id'] != 0 ?? false;

            $this->repository->create($this->cleanRequest($requestData, false));

            return redirect('admin/' . static::getSnakeName())->with('flash_message', 'Успешно добавлена!');

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
        unset($requestData['content']);
    }

    public function creteCleanRequest(&$requestData)
    {
    }
}
