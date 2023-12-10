<?php

namespace App\Services\Api\V1\Users\Role;

use App\Services\Api\V1\Users\Role\Interfaces\DSRoleServiceInterface;
use App\Repositories\Api\V1\Users\Role\Interfaces\RoleRepositoryInterface;

use Illuminate\Http\Response;
use App\Traits\LogsTrait;
use App\Exceptions\BaseException;

class DSRoleService implements DSRoleServiceInterface
{
    use LogsTrait;

    protected $actionCode = 'ROLE';
    protected $messageEntityName;

    /** @var RoleRepositoryInterface $repository */
    protected $repository;

    public function __construct(
        RoleRepositoryInterface $repository,
    ) {
        $this->messageEntityName = config('constants.messages.entities.role');
        $this->repository = $repository;
    }

    public function findByName($name)
    {
        try {
            return $this->repository->findByName($name);
        } catch (\Throwable $e) {
            $messageException = $e->getMessage();

            static::saveLog(
                config('constants.actions.getByName') . $this->actionCode,
                [__FUNCTION__, $name],
                $messageException
            );

            throw new BaseException(
                Response::HTTP_INTERNAL_SERVER_ERROR,
                config('constants.messages.error.listAll') . $this->messageEntityName,
                $messageException
            );
        }
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
                config('constants.messages.error.listAll') . $this->messageEntityName,
                $messageException
            );
        }
    }
}
