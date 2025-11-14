<?php

namespace App\Modules\Domains\Core\src\Repository;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

abstract class CoreRepository implements CoreInterface
{
    protected Model $model;

    /**
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $columns
     * @return Collection
     */
    public function all(array $columns = ['*']): Collection
    {
        return $this->model->select($columns)->get();
    }

    /**
     * @return Builder
     */
    public function query(): Builder
    {
        return $this->model->newQuery();
    }

    /**
     * @param int $perPage
     * @param array $columns
     * @param string $pageName
     * @param int|null $page
     * @return LengthAwarePaginator
     */
    public function paginate(
        int $perPage = 15,
        array $columns = ['*'],
        string $pageName = 'page',
        int $page = null
    ): LengthAwarePaginator {
        return $this->model->select($columns)->paginate($perPage, $columns, $pageName, $page);
    }

    /**
     * @param int|string $id
     * @param array $columns
     * @return Model|null
     */
    public function find(int|string $id, array $columns = ['*']): ?Model
    {
        return $this->model->find($id, $columns);
    }

    /**
     * @param int|string $id
     * @param array $columns
     * @return Model
     */
    public function findOrFail(int|string $id, array $columns = ['*']): Model
    {
        return $this->model->findOrFail($id, $columns);
    }

    /**
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model
    {
        return $this->model->create($data);
    }

    /**
     * @param int|string $id
     * @param array $data
     * @return Model
     */
    public function update(int|string $id, array $data): Model
    {
        $record = $this->findOrFail($id);
        $record->update($data);

        return $record;
    }

    /**
     * @param int|string $id
     * @return bool
     */
    public function delete(int|string $id): bool
    {
        $record = $this->find($id);

        if (!$record) {
            return false;
        }

        return (bool) $record->delete();
    }

    /**
     * @return void
     */
    public function beginTransaction(): void
    {
        DB::beginTransaction();
    }

    /**
     * @return void
     */
    public function commit(): void
    {
        DB::commit();
    }

    /**
     * @return void
     */
    public function rollBack(): void
    {
        DB::rollBack();
    }
}
