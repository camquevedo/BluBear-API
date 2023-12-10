<?php

namespace App\Repositories\Api\V1\Users\Role;

use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

use App\Models\Api\V1\Users\Role;
use App\Repositories\Api\V1\Users\Role\Interfaces\RoleRepositoryInterface;

use stdClass;

class RoleRepository implements RoleRepositoryInterface
{
    protected $table;
    protected $defaultPerPage;

    public function __construct()
    {
        $model = new Role();
        $this->table = $model->getTable();
        $this->defaultPerPage = config('constants.global.defaultPerPage');
    }

    public function findAll(): LengthAwarePaginator
    {
        return DB::table($this->table)
            ->whereNull('deleted_at')
            ->paginate($this->defaultPerPage);
    }

    public function findById($id): ?stdClass
    {
        return DB::table($this->table)
            ->where('id', $id)
            ->whereNull('deleted_at')
            ->first();
    }

    public function findByName(string $name): ?stdClass
    {
        return DB::table($this->table)
            ->where('name', $name)
            ->whereNull('deleted_at')
            ->first();
    }

    public function save($entity): bool
    {
        return $entity->save();
    }

    public function update($id, $entity): bool
    {
        $entity['updated_at'] = now();
        return DB::table($this->table)
            ->where('id', $id)
            ->whereNull('deleted_at')
            ->update($entity);
    }

    public function delete($id): bool
    {
        return DB::table($this->table)
            ->where('id', $id)
            ->whereNull('deleted_at')
            ->update([
                'deleted_at' => now()
            ]);
    }
}