<?php

namespace App\Services\Api\V1\Users\UserRole;

use App\Services\Api\V1\Users\UserRole\Interfaces\DSUserRoleServiceInterface;
use App\Repositories\Api\V1\Users\UserRole\Interfaces\UserRoleRepositoryInterface;

use Illuminate\Http\Response;
use App\Traits\LogsTrait;
use App\Exceptions\BaseException;

class DSUserRoleService implements DSUserRoleServiceInterface
{
    use LogsTrait;

    protected $actionCode = 'ROLE';
    protected $messageEntityName;

    /** @var UserRoleRepositoryInterface $repository */
    protected $repository;

    public function __construct(
        UserRoleRepositoryInterface $repository,
    ) {
        $this->messageEntityName = config('constants.messages.entities.role');
        $this->repository = $repository;
    }

    public function findAll()
    {
        try {
            return $this->repository->findAll();
        } catch (\Throwable $e) {
            $messageException = $e->getMessage();

            static::saveLog(
                config('constants.actions.getAll') . $this->actionCode,
                [__FUNCTION__],
                $messageException
            );

            throw new BaseException(
                Response::HTTP_INTERNAL_SERVER_ERROR,
                config('constants.messages.error.listAll') .
                    $this->messageEntityName,
                $messageException
            );
        }
    }

    public function findByUserId($user_id)
    {
        try {
            return $this->repository->findByUserId($user_id);
        } catch (\Throwable $e) {
            $messageException = $e->getMessage();

            static::saveLog(
                config('constants.actions.getById') . $this->actionCode,
                [__FUNCTION__, $user_id],
                $messageException
            );

            throw new BaseException(
                Response::HTTP_INTERNAL_SERVER_ERROR,
                config('constants.messages.error.list') . $this->messageEntityName,
                $messageException
            );
        }
    }

    public function save($entity)
    {
        try {
            return $this->repository->save($entity);
        } catch (\Throwable $e) {
            $messageException = $e->getMessage();

            static::saveLog(
                config('constants.actions.create') . $this->actionCode,
                [__FUNCTION__, entityToString($entity)],
                $messageException
            );

            throw new BaseException(
                Response::HTTP_BAD_REQUEST,
                config('constants.messages.error.save') . $this->messageEntityName,
                $messageException
            );
        }
    }

    public function update($user_id, $rol_id, $entity)
    {
        try {
            return $this->repository->update($user_id, $rol_id, $entity);
        } catch (\Throwable $e) {
            $messageException = $e->getMessage();

            static::saveLog(
                config('constants.actions.update') . $this->actionCode,
                [__FUNCTION__, $user_id, $rol_id, entityToString($entity)],
                $messageException
            );

            throw new BaseException(
                Response::HTTP_INTERNAL_SERVER_ERROR,
                config('constants.messages.error.update') . $this->messageEntityName,
                $messageException
            );
        }
    }

    public function delete($user_id, $role_id)
    {
        try {
            return $this->repository->delete($user_id, $role_id);
        } catch (\Throwable $e) {
            $messageException = $e->getMessage();

            static::saveLog(
                config('constants.actions.delete') . $this->actionCode,
                [__FUNCTION__, $user_id, $role_id],
                $messageException
            );

            throw new BaseException(
                Response::HTTP_INTERNAL_SERVER_ERROR,
                config('constants.messages.error.delete') . $this->messageEntityName,
                $messageException
            );
        }
    }
}
