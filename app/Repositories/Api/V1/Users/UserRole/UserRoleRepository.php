<?php

namespace App\Repositories\Api\V1\Users\UserRole;

use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

use App\Models\Api\V1\Users\UserRole;
use App\Repositories\Api\V1\Users\UserRole\Interfaces\UserRoleRepositoryInterface;

use stdClass;

class UserRoleRepository implements UserRoleRepositoryInterface
{
    protected $table;
    protected $defaultPerPage;

    public function __construct()
    {
        $model = new UserRole();
        $this->table = $model->getTable();
        $this->defaultPerPage = config('constants.global.defaultPerPage');
    }

    public function findAll(): LengthAwarePaginator
    {
        return DB::table($this->table)
            ->whereNull('deleted_at')
            ->paginate($this->defaultPerPage);
    }

    public function findByUserId($user_id): ?stdClass
    {
        return DB::table($this->table)
            ->where('user_id', $user_id)
            ->whereNull('deleted_at')
            ->first();
    }

    public function save($entity): bool
    {
        return $entity->save();
    }

    public function update($user_id, $role_id, $entity): bool
    {
        $entity['updated_at'] = now();
        return DB::table($this->table)
            ->where('user_id', $user_id)
            ->where('rol_id', $role_id)
            ->whereNull('deleted_at')
            ->update($entity);
    }

    public function delete($user_id, $role_id): bool
    {
        return DB::table($this->table)
            ->where('user_id', $user_id)
            ->where('rol_id', $role_id)
            ->update([
                'deleted_at' => now()
            ]);
    }
}