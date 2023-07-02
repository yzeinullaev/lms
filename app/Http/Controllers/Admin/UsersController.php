<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserEnum;
use App\Http\Controllers\CrudController;
use App\Http\Requests\IndexRequest;
use App\Repositories\LanguageRepository;
use App\Repositories\TranslateRepository;
use App\Repositories\UserRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Hash;
use Throwable;

class UsersController extends CrudController
{
    /**
     * @param UserRepository $repository
     * @param TranslateRepository $translateRepository
     * @param LanguageRepository $languageRepository
     */
    public function __construct(protected UserRepository      $repository,
                                protected TranslateRepository $translateRepository,
                                protected LanguageRepository  $languageRepository)
    {
    }

    /**
     * @param IndexRequest $request
     * @return Factory|View|Application
     */
    public function index(IndexRequest $request): Factory|View|Application
    {
        return parent::index($request)->with('rolesMap', UserEnum::ROLES_MAP);
    }

    /**
     * @param string|null $parentId
     * @return View|Factory|Application
     */
    public function create(string $parentId = null): View|Factory|Application
    {
        return parent::create()->with('rolesMap', UserEnum::ROLES_MAP);
    }

    /**
     * @param string $id
     * @return View|Factory|Application
     */
    public function show(string $id): View|Factory|Application
    {
        return parent::show($id)->with('rolesMap', UserEnum::ROLES_MAP);
    }

    /**
     * @param string $id
     * @param string|null $parentId
     * @return View|Factory|Application
     */
    public function edit(string $id, string $parentId = null): View|Factory|Application
    {
        return parent::edit($id)->with('rolesMap', UserEnum::ROLES_MAP);
    }

    public function update(Request $request, int $id): Redirector|RedirectResponse|Application
    {
        $requestData = $request->all();

        try {

            $user = $this->repository->find($id);

            if ($requestData['password'] == NULL) {
                $requestData['password'] = $user->password;
            } else {
                $requestData['password'] = Hash::make($requestData['password']);
            }

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

            $requestData['password'] = Hash::make($requestData['password']);

            $this->repository->create($this->cleanRequest($requestData, false));

            return redirect('admin/' . static::getSnakeName())->with('flash_message', 'Успешно добавлена!');

        } catch (Throwable $th) {
            return redirect('admin/' . static::getSnakeName())->with('error', $th->getMessage());
        }
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

    public function beforeUpdate(&$requestData, int $id)
    {
    }
}
