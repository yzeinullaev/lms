<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\CrudController;
use App\Http\Requests\IndexRequest;
use App\Repositories\LanguageRepository;
use App\Repositories\TranslateRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Throwable;

class LanguagesController extends CrudController
{
    /**
     * @param LanguageRepository $repository
     * @param TranslateRepository $translateRepository
     */
    public function __construct(protected LanguageRepository $repository,
                                protected TranslateRepository $translateRepository)
    {
    }

    /**
     * @param IndexRequest $request
     * @return Factory|View|Application
     */
    public function index(IndexRequest $request): Factory|View|Application
    {
        $data = $this->repository->latestPaginate();
        return view($this->getViewName($this->indexView), compact('data'));
    }

    /**
     * @param Request $request
     * @return Redirector|RedirectResponse|Application
     */
    public function store(Request $request): Redirector|RedirectResponse|Application
    {
        $requestData = $request->all();

        try {

            if ($request->hasFile('image')) {
                $requestData['image'] = $request->file('image')
                    ->store(static::getSnakeName(), 'custom');
            }

            $this->repository->create($this->cleanRequest($requestData, false));
            $this->repository->creteNewSlug($requestData['slug']);

            return redirect('admin/' . static::getSnakeName())->with('flash_message', 'Успешно добавлена!');

        } catch (Throwable $th) {
            return redirect('admin/' . static::getSnakeName())->with('error', $th->getMessage());
        }
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

            if ($request->hasFile('image')) {
                $requestData['image'] = $request->file('image')
                    ->store(static::getSnakeName(), 'custom');
            }

            $this->repository->update($id, $this->cleanRequest($requestData));

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
