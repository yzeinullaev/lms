<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\CrudController;
use App\Http\Requests\IndexRequest;
use App\Repositories\BlockItemsRepository;
use App\Repositories\BlocksRepository;
use App\Repositories\LanguageRepository;
use App\Repositories\TranslateRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Throwable;

class BlockItemsController extends CrudController
{
    /**
     * @param BlockItemsRepository $repository
     * @param TranslateRepository $translateRepository
     * @param LanguageRepository $languageRepository
     * @param BlocksRepository $blocksRepository
     */
    public function __construct(protected BlockItemsRepository $repository,
                                protected TranslateRepository $translateRepository,
                                protected LanguageRepository $languageRepository,
                                protected BlocksRepository $blocksRepository)
    {
    }


    /**
     * @param IndexRequest $request
     * @return Factory|View|Redirector|RedirectResponse|Application
     */
    public function index(IndexRequest $request): Factory|View|Redirector|RedirectResponse|Application
    {
        try {
            if (!$request->block_id) {
                return redirect('admin/blocks')->with('error', 'Не найден родительский блок!');
            }

            $parentData = $this->blocksRepository->first(['id' => $request->block_id]);
            $data = $this->repository->getLatestPaginateByParentId($request->block_id);
            $lang = $this->languageRepository->getSlugById();

            return view($this->getViewName($this->indexView), compact('data', 'lang', 'parentData'));

        } catch (Throwable $th) {
            return redirect('admin/' . static::getSnakeName())->with('error', $th->getMessage());
        }
    }

    /**
     * @param string|null $parentId
     * @return View|Factory|Application
     */
    public function create(string $parentId = null): View|Factory|Application
    {
        if (!$parentId) {
            return redirect('admin/blocks')->with('error', 'Не найден родительский блок');
        }

        $parentData = $this->blocksRepository->first(['id' => $parentId]);
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
            return redirect('admin/blocks')->with('error', 'Не найден родительский блок');
        }

        $parentData = $this->blocksRepository->first(['id' => $parentId]);
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
            unset($requestData['content']);
            unset($requestData['icon']);
            $this->repository->update($id, $this->cleanRequest($requestData, false));

            return redirect('admin/' . static::getSnakeName() . '/block/' . $requestData['block_id'])->with('flash_message', 'Данные изменены!');

        } catch (Throwable $th) {
            return redirect('admin/' . static::getSnakeName() . '/block/' . $requestData['block_id'])->with('error', $th->getMessage());
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

            return redirect('admin/' . static::getSnakeName() . '/block/' . $requestData['block_id'])->with('flash_message', 'Успешно добавлена!');
        } catch (Throwable $th) {
            return redirect('admin/' . static::getSnakeName() . '/block/' . $requestData['block_id'])->with('error', $th->getMessage());
        }
    }

    /**
     * @param string $id
     * @return Redirector|RedirectResponse|Application
     */
    public function destroy(string $id): Redirector|RedirectResponse|Application
    {
        $parent = $this->repository->find($id);

        try {
            $this->repository->destroy($id);
            return redirect('admin/' . static::getSnakeName() . '/block/' . $parent->block_id)->with('flash_message', 'Успешно удалена!');

        } catch (Throwable $th) {
            return redirect('admin/' . static::getSnakeName() . '/block/' . $parent->block_id)->with('error', $th->getMessage());
        }
    }


    /**
     * @param $requestData
     * @param $id
     */
    public function afterUpdate(&$requestData, $id)
    {
    }


    public function beforeUpdate(&$requestData, $id)
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
