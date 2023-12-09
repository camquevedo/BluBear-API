<?php

namespace App\Repositories\Api\V1\Users;

use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

use App\Models\Api\V1\Users\User;
use App\Repositories\Api\V1\Users\Interfaces\UserRepositoryInterface;

use stdClass;

class UserRepository implements UserRepositoryInterface
{
    protected $table;
    protected $defaultPerPage;

    public function __construct()
    {
        $model = new User();
        $this->table = $model->getTable();
        $this->defaultPerPage = config('constants.global.defaultPerPage');
    }

    public function findAll(): LengthAwarePaginator
    {
        // dd (DB::table($this->table)
        //     ->whereNull('deleted_at')
        //     ->paginate($this->defaultPerPage));
        return DB::table($this->table)
            ->whereNull('deleted_at')
            ->paginate($this->defaultPerPage);
    }

    public function findById($id): ?stdClass
    {
        return DB::table($this->table)
            ->where('id', $id)
            ->where('status', 1)
            ->whereNull('deleted_at')
            ->first();
    }

    public function findByEmail(string $email): ?stdClass
    {
        return DB::table($this->table)
            ->where('email', $email)
            ->where('status', 1)
            ->whereNull('deleted_at')
            ->first();
    }

    public function findPasswordById(int $id): ?stdClass
    {
        return DB::table($this->table)
            ->select('password', 'social_media_id')
            ->where('id', $id)
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
                'status' => 0,
                'deleted_at' => now()
            ]);
    }
}