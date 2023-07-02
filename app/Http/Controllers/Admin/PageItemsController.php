<?php

namespace App\Http\Controllers\Admin;


use App\Enums\PageTypeEnum;
use App\Http\Controllers\CrudController;
use App\Http\Requests\IndexRequest;
use App\Repositories\LanguageRepository;
use App\Repositories\PageItemsRepository;
use App\Repositories\PagesRepository;
use App\Repositories\TranslateRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Throwable;

class PageItemsController extends CrudController
{
    /**
     * @param PageItemsRepository $repository
     * @param TranslateRepository $translateRepository
     * @param LanguageRepository $languageRepository
     * @param PagesRepository $pagesRepository
     */
    public function __construct(protected PageItemsRepository $repository,
                                protected TranslateRepository $translateRepository,
                                protected LanguageRepository $languageRepository,
                                protected PagesRepository $pagesRepository)
    {
    }


    /**
     * @param IndexRequest $request
     * @return Factory|View|Redirector|RedirectResponse|Application
     */
    public function index(IndexRequest $request): Factory|View|Redirector|RedirectResponse|Application
    {
        try {
            if (!$request->page_id) {
                return redirect('admin/pages')->with('error', 'Не найден родительская страница!');
            }

            $parentData = $this->pagesRepository->first(['id' => $request->page_id]);
            $data = $this->repository->getLatestPaginateByParentId($request->page_id);
            $lang = $this->languageRepository->getSlugById();

            return view($this->getViewName($this->indexView), compact('data', 'lang', 'parentData'));
        } catch (Throwable $th) {
            return redirect('admin/' . static::getSnakeName())->with('error', $th->getMessage());
        }
    }

    /**
     * @param string|null $parentId
     * @return View|Factory|Application
     * @throws \Exception
     */
    public function create(string $parentId = null): View|Factory|Application
    {
        if (!$parentId) {
            return redirect('admin/pages')->with('error', 'Не найден родительская страница!');
        }

        $parentData = $this->pagesRepository->first(['id' => $parentId]);
        $parent = parent::create($parentId)->with('parentData', $parentData);

        if (isset(PageTypeEnum::SELECTED_TYPES[request()->query('type')])) {
            $typeData = $this->repository->storeByPageType(request()->query('type'));
            $parent->with('typeData', $typeData)->with('type', request()->query('type'));
        } else {
            $parent->with('type', request()->query('type'));
        }

        return $parent;
    }

    /**
     * @param string $id
     * @param string|null $parentId
     * @return View|Factory|Application
     * @throws \Exception
     */
    public function edit(string $id, string $parentId = null): View|Factory|Application
    {
        if (!$parentId) {
            return redirect('admin/pages')->with('error', 'Не найден родительская страница!');
        }

        $parentData = $this->pagesRepository->first(['id' => $parentId]);
        $parent = parent::edit($id, $parentId)->with('parentData', $parentData);

        if (isset(PageTypeEnum::SELECTED_TYPES[request()->query('type')])) {
            $typeData = $this->repository->storeByPageType(request()->query('type'));
            $parent->with('typeData', $typeData)->with('type', request()->query('type'));
        } else {
            $parent->with('type', request()->query('type'));
        }

        return $parent;
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
            return redirect('admin/' . static::getSnakeName() . '/page/' . $requestData['page_id'])->with('flash_message', 'Данные изменены!');
        } catch (Throwable $th) {
            return redirect('admin/' . static::getSnakeName() . '/page/' . $requestData['page_id'])->with('error', $th->getMessage());
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
            $this->repository->create($this->cleanRequest($requestData, false));
            return redirect('admin/' . static::getSnakeName() . '/page/' . $requestData['page_id'])->with('flash_message', 'Успешно добавлена!');
        } catch (Throwable $th) {
            return redirect('admin/' . static::getSnakeName() . '/page/' . $requestData['page_id'])->with('error', $th->getMessage());
        }
    }

    /**
     * @param string $id
     * @return Redirector|RedirectResponse|Application
     */
    public function destroy(string $id): Redirector|RedirectResponse|Application
    {
        try {
            $this->repository->destroy($id);
            return redirect('admin/' . static::getSnakeName() . '/page/' . request()->page_id)->with('flash_message', 'Успешно удалена!');

        } catch (Throwable $th) {
            return redirect('admin/' . static::getSnakeName() . '/page/' . request()->page_id)->with('error', $th->getMessage());
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
