<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\CrudController;
use App\Http\Requests\IndexRequest;
use App\Repositories\CourseProgramRepository;
use App\Repositories\CourseRepository;
use App\Repositories\LanguageRepository;
use App\Repositories\TranslateRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Throwable;

class CourseProgramsController extends CrudController
{
    /**
     * @param CourseProgramRepository $repository
     * @param TranslateRepository $translateRepository
     * @param LanguageRepository $languageRepository
     * @param CourseRepository $courseRepository
     */
    public function __construct(protected CourseProgramRepository $repository,
                                protected TranslateRepository     $translateRepository,
                                protected LanguageRepository      $languageRepository,
                                protected CourseRepository        $courseRepository)
    {
    }


    /**
     * @param IndexRequest $request
     * @return Factory|View|Redirector|RedirectResponse|Application
     */
    public function index(IndexRequest $request): Factory|View|Redirector|RedirectResponse|Application
    {
        try {

            if (!$request->course_id) {
                return redirect('admin/courses')->with('error', 'Не найден родительский курс');
            }

            $parentData = $this->courseRepository->first(['id' => $request->course_id]);
            $data = $this->repository->getLatestPaginateByParentId($request->course_id);
            $lang = $this->languageRepository->getSlugById();

            return view($this->getViewName($this->indexView), compact('data', 'lang', 'parentData'));

        } catch (Throwable $th) {
            return redirect('admin/' . static::getSnakeName() . '/course/' . $request->course_id)->with('error', $th->getMessage());
        }
    }


    /**
     * @param string $id
     * @param string|null $parentId
     * @return View|Factory|Application
     */
    public function edit(string $id, string $parentId = null): View|Factory|Application
    {
        if (!$parentId) {
            return redirect('admin/courses')->with('error', 'Не найден родительский курс');
        }

        $parentData = $this->courseRepository->first(['id' => $parentId]);
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
            $this->translateRepository->updateTranslate($this->repository->findOrFail($id), $requestData);
            $this->translateRepository->updateTranslate($this->repository->findOrFail($id), $requestData, 'content');

            $this->repository->update($id, $this->cleanRequest($requestData));
            return redirect('admin/' . static::getSnakeName() . '/course/' . $requestData['course_id'])->with('flash_message', 'Данные изменены!');

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
            return redirect('admin/courses')->with('error', 'Не найден родительский курс');
        }

        $parentData = $this->courseRepository->first(['id' => $parentId]);
        return parent::create($parentId)->with('parentData', $parentData);
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

            $this->repository->create($this->cleanRequest($requestData, false));

            return redirect('admin/' . static::getSnakeName() . '/course/' . $requestData['course_id'])->with('flash_message', 'Успешно добавлена!');

        } catch (Throwable $th) {
            return redirect('admin/' . static::getSnakeName() . '/course/' . $requestData['course_id'])->with('error', $th->getMessage());
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
            return redirect('admin/' . static::getSnakeName() . '/course/' . $parent->course_id)->with('flash_message', 'Успешно удалена!');

        } catch (Throwable $th) {
            return redirect('admin/' . static::getSnakeName() . '/course/' . $parent->course_id)->with('error', $th->getMessage());
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
        unset($requestData['content']);
    }

    public function creteCleanRequest(&$requestData)
    {
    }
}
