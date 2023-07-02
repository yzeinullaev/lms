<?php

namespace App\Repositories\Eloquent;

use App\Enums\ConstantEnum;
use Closure;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BaseRepository implements IBaseRepository
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): Model
    {
        return $this->model->query()->create($attributes);
    }

    /**
     * @param $id
     * @return Model|null
     */
    public function find($id): ?Model
    {
        return $this->model->query()->find($id);
    }

    /**
     * @param $id
     * @param $columns
     * @return Model
     */
    public function findOrNew($id, $columns = ['*']): Model
    {
        return $this->model->query()->findOrNew($id, $columns);
    }

    /**
     * @param $id
     * @return Model|Collection|Builder|array|null
     */
    public function findOrFail($id): Model|Collection|Builder|array|null
    {
        return $this->model->query()->findOrFail($id);
    }

    /**
     * @param array $attributes
     * @param array $values
     * @return Model
     */
    public function firstOrCreate(array $attributes = [], array $values = []): Model
    {
        return $this->model->query()->firstOrCreate($attributes, $values);
    }

    /**
     * @param array $columns
     * @return Model|ModelNotFoundException
     */
    public function firstOrFail(array $columns = ['*']): Model|ModelNotFoundException
    {
        return $this->model->query()->firstOrFail($columns);
    }

    /**
     * @param array $condition
     * @return Model|Builder|null
     */
    public function first(array $condition = []): Model|Builder|null
    {
        return $this->model->query()->where($condition)->first() ?? null;
    }

    /**
     * @param array $columns
     * @param Closure|null $callback
     * @return Model|Closure
     */
    public function firstOr(array $columns = ['*'], Closure $callback = null): Model|Closure
    {
        return $this->model->query()->firstOr($columns, $callback);
    }

    /**
     * @param array $condition
     * @return Collection
     */
    public function get(array $condition = []): Collection
    {
        return $this->model->query()->where($condition)->get();
    }

    /**
     * @param array $condition
     * @return bool
     */
    public function exists(array $condition): bool
    {
        return $this->model->query()->where($condition)->exists();
    }

    /**
     * @param int $id
     * @param array $requestData
     * @return mixed
     */
    public function update(int $id, array $requestData): mixed
    {
        return $this->model->query()
            ->whereId($id)
            ->update($requestData);
    }

    /**
     * @return array
     */
    public function getById(): array
    {
        return $this->model->query()->orderBy('id', 'ASC')->get()->toArray();
    }

    /**
     * @return LengthAwarePaginator
     */
    public function latestPaginate(): LengthAwarePaginator
    {
        return $this->model->query()->latest()->paginate(ConstantEnum::DEFAULT_PAGINATE);
    }

    /**
     * @param $id
     * @return int
     */
    public function destroy($id): int
    {
        return $this->model::destroy($id);
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->all();
    }

    /**
     * @return Builder
     */
    public function query(): Builder
    {
        return $this->model->query();
    }


    /**
     * @param string $keyword
     * @param string $lang
     * @return mixed
     */
    public function search(string $keyword, string $lang): mixed
    {
        return $this->model->search($keyword, $lang)->latest()->paginate(ConstantEnum::DEFAULT_PAGINATE);
    }

}
