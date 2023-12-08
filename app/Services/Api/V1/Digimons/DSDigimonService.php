<?php

namespace App\Services\Api\V1\Digimons;

use App\Services\Api\V1\Digimons\Interfaces\DSDigimonServiceInterface;
use App\Repositories\Api\V1\Digimons\Interfaces\DigimonRepositoryInterface;

use Illuminate\Http\Response;
use App\Traits\LogsTrait;
use App\Exceptions\BaseException;

class DSDigimonService implements DSDigimonServiceInterface
{
    use LogsTrait;

    protected $actionCode = 'DIGIMON';
    protected $messageEntityName;

    /** @var DigimonRepositoryInterface $repository */
    protected $repository;

    public function __construct(
        DigimonRepositoryInterface $repository,
    ) {
        $this->messageEntityName = config('constants.messages.entities.digimon');
        $this->repository = $repository;
    }

    public function findByParameter($parameter)
    {
        try {
            return $this->repository->findByParameter($parameter);
        } catch (\Throwable $e) {
            $messageException = $e->getMessage();

            static::saveLog(
                config('constants.actions.getByParameter') . $this->actionCode,
                [__FUNCTION__, $parameter],
                $messageException
            );

            throw new BaseException(
                Response::HTTP_INTERNAL_SERVER_ERROR,
                config('constants.messages.error.listAll') . $this->messageEntityName,
                $messageException
            );
        }
    }

    public function findAll($page)
    {
        // dd($this->repository->findAll());
        try {
            return $this->repository->findAll($page);
        } catch (\Throwable $e) {
            $messageException = $e->getMessage();

            static::saveLog(
                config('constants.actions.getAll') . $this->actionCode,
                [__FUNCTION__, $page],
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
