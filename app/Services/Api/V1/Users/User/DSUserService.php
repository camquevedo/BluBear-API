<?php

namespace App\Services\Api\V1\Users\User;

use App\Services\Api\V1\Users\User\Interfaces\DSUserServiceInterface;
use App\Repositories\Api\V1\Users\User\Interfaces\UserRepositoryInterface;
use App\Services\Api\V1\Users\Role\Interfaces\RoleServiceInterface;
use App\Services\Api\V1\Users\UserRole\Interfaces\UserRoleServiceInterface;

use Illuminate\Http\Response;
use App\Traits\LogsTrait;
use App\Exceptions\BaseException;

class DSUserService implements DSUserServiceInterface
{
    use LogsTrait;

    protected $actionCode = 'USER';
    protected $messageEntityName;

    /** @var UserRepositoryInterface $repository */
    protected $repository;

    /** @var RoleServiceInterface $roleService */
    protected $roleService;

    /** @var UserRoleServiceInterface $userRoleService */
    protected $userRoleService;

    public function __construct(
        UserRepositoryInterface $repository,
        RoleServiceInterface $roleService,
        UserRoleServiceInterface $userRoleService
    ) {
        $this->messageEntityName = config('constants.messages.entities.user');
        $this->repository = $repository;
        $this->roleService = $roleService;
        $this->userRoleService = $userRoleService;
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

    public function findById($id)
    {
        try {
            return $this->repository->findById($id);
        } catch (\Throwable $e) {
            $messageException = $e->getMessage();

            static::saveLog(
                config('constants.actions.getById') . $this->actionCode,
                [__FUNCTION__, $id],
                $messageException
            );

            throw new BaseException(
                Response::HTTP_INTERNAL_SERVER_ERROR,
                config('constants.messages.error.list') . $this->messageEntityName,
                $messageException
            );
        }
    }

    public function findByEmail($email)
    {
        try {
            return $this->repository->findByEmail($email);
        } catch (\Throwable $e) {
            $messageException = $e->getMessage();

            static::saveLog(
                'GET_BY_EMAIL_' . $this->actionCode,
                [__FUNCTION__, $email],
                $messageException
            );

            throw new BaseException(
                Response::HTTP_INTERNAL_SERVER_ERROR,
                config('constants.messages.error.list') . $this->messageEntityName,
                $messageException
            );
        }
    }

    public function findPasswordById($id)
    {
        try {
            return $this->repository->findPasswordById($id);
        } catch (\Throwable $e) {
            $messageException = $e->getMessage();

            static::saveLog(
                config('constants.actions.getById') . $this->actionCode,
                [__FUNCTION__, $id],
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

    public function update($id, $entity)
    {
        try {
            return $this->repository->update($id, $entity);
        } catch (\Throwable $e) {
            $messageException = $e->getMessage();

            static::saveLog(
                config('constants.actions.update') . $this->actionCode,
                [__FUNCTION__, $id, entityToString($entity)],
                $messageException
            );

            throw new BaseException(
                Response::HTTP_INTERNAL_SERVER_ERROR,
                config('constants.messages.error.update') . $this->messageEntityName,
                $messageException
            );
        }
    }

    public function delete($id)
    {
        try {
            return $this->repository->delete($id);
        } catch (\Throwable $e) {
            $messageException = $e->getMessage();

            static::saveLog(
                config('constants.actions.delete') . $this->actionCode,
                [__FUNCTION__, $id],
                $messageException
            );

            throw new BaseException(
                Response::HTTP_INTERNAL_SERVER_ERROR,
                config('constants.messages.error.delete') . $this->messageEntityName,
                $messageException
            );
        }
    }

    public function findRoleByName($name)
    {
        $serviceResponse = $this->roleService->getByName($name);
        $serviceData = $serviceResponse->getData();
        return !collect($serviceData)->isEmpty() ? $serviceData->items : null;
    }

    public function saveUserRole($entity)
    {
        $serviceResponse = $this->userRoleService->create($entity);
        $serviceData = $serviceResponse->getData();
        return !collect($serviceData)->isEmpty() ? $serviceData->items : null;
    }

    public function updateUserRole($user_id, $role_id, $entity)
    {
        $serviceResponse = $this->userRoleService->edit($user_id, $role_id, $entity);
        $serviceData = $serviceResponse->getData();
        return !collect($serviceData)->isEmpty() ? $serviceData->items : null;
    }
}
