<?php

namespace App\Repositories\Api\V1\Digimons;

use App\Repositories\Api\V1\Digimons\Interfaces\DigimonRepositoryInterface;

use Illuminate\Support\Facades\Http;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

use stdClass;

class DigimonRepository implements DigimonRepositoryInterface
{

    protected $defaultPerPage;
    protected $config;
    protected $basePath;
    public function __construct()
    {
        $this->defaultPerPage = config('constants.global.defaultPerPage');
        $this->config = config('constants.digimons');
        $this->basePath = $this->config['apiUrl'] . $this->config['apiVersion'];
    }

    public function findAll($page): LengthAwarePaginator | stdClass
    {
        $url = $this->basePath . '/digimon?page=' . $page . '&pageSize=10';
        // $url = $this->basePath . '/digimon?page=' . $page;
        $request = Http::get($url);

        return $request->object();
    }

    public function findByParameter($parameter): ?stdClass
    {
        $url = $this->basePath . '/digimon/' . $parameter;
        $request = Http::get($url);

        return $request->object();
    }
}
