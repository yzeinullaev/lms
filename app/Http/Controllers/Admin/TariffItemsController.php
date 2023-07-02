<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\CrudController;
use App\Http\Requests\IndexRequest;
use App\Repositories\LanguageRepository;
use App\Repositories\TariffItemsRepository;
use App\Repositories\TariffsRepository;
use App\Repositories\TranslateRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Throwable;

class TariffItemsController extends CrudController
{
    /**
     * @param TariffItemsRepository $repository
     * @param TranslateRepository $translateRepository
     * @param LanguageRepository $languageRepository
     * @param TariffsRepository $tariffsRepository
     */
    public function __construct(protected TariffItemsRepository $repository,
                                protected TranslateRepository $translateRepository,
                                protected LanguageRepository $languageRepository,
                                protected TariffsRepository $tariffsRepository)
    {
    }


    /**
     * @param IndexRequest $request
     * @return Factory|View|Redirector|RedirectResponse|Application
     */
    public function index(IndexRequest $request): Factory|View|Redirector|RedirectResponse|Application
    {
        try {
            if (!$request->tariff_id) {
                return redirect('admin/tariffs')->with('error', 'Не найден родительский тариф!');
            }

            $parentData = $this->tariffsRepository->first(['id' => $request->tariff_id]);
            $data = $this->repository->getLatestPaginateByParentId($request->tariff_id);
            $lang = $this->languageRepository->getSlugById();

            return view($this->getViewName($this->indexView), compact('data', 'lang', 'parentData'));

        } catch (Throwable $th) {
            return redirect('admin/' . static::getSnakeName() . '/tariff/' . $request->tariff_id)->with('error', $th->getMessage());
        }
    }

    /**
     * @param string|null $parentId
     * @return View|Factory|Application
     */
    public function create(string $parentId = null): View|Factory|Application
    {
        if (!$parentId) {
            return redirect('admin/tariffs')->with('error', 'Не найден родительский блок');
        }

        $parentData = $this->tariffsRepository->first(['id' => $parentId]);
        return parent::create($parentId)->with('parentData', $parentData);
    }

    /**
     * @param string $id
     * @param string|null $parentId
     * @return View|Factory|Application
     */
    public function edit(string $id, string $parentId = null): View|Factory|Application
    {
        if (!$parentId) {
            return redirect('admin/tariffs')->with('error', 'Не найден родительский блок');
        }

        $parentData = $this->tariffsRepository->first(['id' => $parentId]);
        return parent::edit($id, $parentId)->with('parentData', $parentData);
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
            $this->translateRepository->updateTranslate($this->repository->findOrFail($id), $requestData, 'content');
            $this->repository->updateMultiMediaFiles($id, $request, static::getSnakeName());
            $this->repository->update($id, $this->cleanRequest($requestData));

            return redirect('admin/' . static::getSnakeName() . '/tariff/' . $requestData['tariff_id'])->with('flash_message', 'Данные изменены!');

        } catch (Throwable $th) {
            return redirect('admin/' . static::getSnakeName() . '/tariff/' . $requestData['tariff_id'])->with('error', $th->getMessage());
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

            $requestData['content'] = $this->translateRepository->storeTranslate($requestData, 'content');
            $requestData['icon'] = $this->repository->creteMultiMediaFiles($request, static::getSnakeName());
            $this->repository->create($this->cleanRequest($requestData, false));

            return redirect('admin/' . static::getSnakeName() . '/tariff/' . $requestData['tariff_id'])->with('flash_message', 'Успешно добавлена!');

        } catch (Throwable $th) {
            return redirect('admin/' . static::getSnakeName() . '/tariff/' . $requestData['tariff_id'])->with('error', $th->getMessage());
        }
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
        unset($requestData['content']);
        unset($requestData['icon']);
    }

    /**
     * @param $requestData
     */
    public function creteCleanRequest(&$requestData)
    {
    }
}
