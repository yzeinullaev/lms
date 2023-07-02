<?php

namespace App\Repositories\Eloquent;

use Closure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Interface IBaseRepository
 */
interface IBaseRepository
{
    /**
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): Model;

    /**
     * @param $id
     * @return Model|null
     */
    public function find($id): ?Model;

    /**
     * @param $id
     * @param string[] $columns
     * @return Model
     */
    public function findOrNew($id, array $columns = ['*']): Model;

    /**
     * @param string[] $columns
     * @return Model|ModelNotFoundException
     */
    public function firstOrFail(array $columns = ['*']): Model|ModelNotFoundException;

    /**
     * @param string[] $columns
     * @param Closure|null $callback
     * @return Model|Closure
     */
    public function firstOr(array $columns = ['*'], Closure $callback = null): Model|Closure;
}
