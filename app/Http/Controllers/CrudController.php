<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Str;
use ReflectionClass;
use Throwable;

/**
 * Базовый CRUD контроллер
 *
 * Class CrudController
 * @author Zeinullayev Yernur
 */
abstract class CrudController extends Controller implements ICrudController
{
    protected string $indexView = 'index';
    protected string $showView = 'show';
    protected string $editView = 'edit';
    protected string $createView = 'create';

    public function __construct($repository,
                                $translateRepository,
                                $languageRepository = null,
                                $additionalRepository = null)
    {
        $this->repository = $repository;
        $this->translateRepository = $translateRepository;
        $this->languageRepository = $languageRepository;
        $this->additionalRepository = $additionalRepository;
    }


    /**
     * @param IndexRequest $request
     * @return Factory|View|Redirector|RedirectResponse|Application
     */
    public function index(IndexRequest $request): Factory|View|Redirector|RedirectResponse|Application
    {
        try {

            $lang = $this->languageRepository->getSlugById();
            $data = $this->repository->latestPaginate();

            if (isset($request['search']) && !empty($request['search'])) {
                $data = $this->repository->search($request['search'], $lang);
            }

            return view($this->getViewName($this->indexView), compact('data', 'lang'));

        } catch (Throwable $th) {
            return redirect('admin/' . static::getSnakeName())->with('error', $th->getMessage());
        }
    }

    /**
     * @param string $id
     * @return View|Factory|Application
     */
    public function show(string $id): View|Factory|Application
    {
        $data = $this->repository->findOrFail($id);
        return view($this->getViewName($this->showView), compact('data'));
    }


    /**
     * @param string $id
     * @param string|null $parentId
     * @return Application|Factory|View
     */
    public function edit(string $id, string $parentId = null): View|Factory|Application
    {
        $data = $this->repository->findOrFail($id);
        return view($this->getViewName($this->editView), compact('data'));
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
            $this->beforeUpdate($requestData, $id);
            $this->translateRepository->updateTranslate($this->repository->findOrFail($id), $requestData);
            $this->repository->update($id, $this->cleanRequest($requestData));
            $this->afterUpdate($requestData, $id);

            return redirect('admin/' . static::getSnakeName())->with('flash_message', 'Данные изменены!');

        } catch (Throwable $th) {
            return redirect('admin/' . static::getSnakeName())->with('error', $th->getMessage());
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
            return redirect('admin/' . static::getSnakeName())->with('flash_message', 'Успешно удалена!');

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
        return view($this->getViewName($this->createView));
    }


    /**
     * @param Request $request
     * @return Redirector|RedirectResponse|Application
     */
    public function store(Request $request): Redirector|RedirectResponse|Application
    {
        $requestData = $request->all();

        try {
            $this->beforeCreate($requestData);
            $requestData['name'] = $this->translateRepository->storeTranslate($requestData);
            $this->afterCreate($requestData);

            $this->repository->create($this->cleanRequest($requestData, false));

            return redirect('admin/' . static::getSnakeName())->with('flash_message', 'Успешно добавлена!');

        } catch (Throwable $th) {
            return redirect('admin/' . static::getSnakeName())->with('error', $th->getMessage());
        }
    }


    /**
     * @param string $name
     * @return string
     */
    public function getViewName(string $name): string
    {
        return 'admin.' . static::getSnakeName() . '.' . $name;
    }


    /**
     * @return array|string
     */
    public static function getName(): array|string
    {
        $reflection = new ReflectionClass(static::class);
        return str_replace('Controller', '', $reflection->getShortName());
    }


    /**
     * @return string
     */
    public static function getKebabName(): string
    {
        return Str::kebab(static::getLowerName());
    }

    /**
     * @return string
     */
    public static function getSnakeName(): string
    {
        return Str::snake(static::getName(), '-');
    }


    /**
     * @return string
     */
    public static function getLowerName(): string
    {
        return strtolower(static::getName());
    }


    /**
     * @param array $requestData
     * @param bool $update
     * @return array
     */
    protected function cleanRequest(array $requestData, bool $update = true): array
    {
        unset($requestData['_method']);
        unset($requestData['_token']);

        if ($update) {
            unset($requestData['name']);
            $this->updateCleanRequest($requestData);
        }

        $this->creteCleanRequest($requestData);

        return $requestData;
    }
}
