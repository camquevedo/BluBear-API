<?php

namespace App\Http\Controllers\Api\V1\Digimons;

use App\Packages\ApiResponse\ApiResponseBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

use Inertia\Inertia;
use Inertia\Response;

class ViewsDigimonController extends DigimonController
{
    protected $properties = [
        'info.taxId' => 'required|numeric',
        'info.productId' => 'required|numeric',
        'info.cityId' => 'required|numeric',
        'info.value' => 'required|numeric'
    ];

    public function index(Request $request): Response
    {
        $digimons = $this->getAll($request);
        return Inertia::render('Digimon/index', [
            'request' => $request,
            'digimons' => $digimons,
        ]);
    }

    public function fetchByParameter(string|int $parameter) {
        $digimons = $this->getbyParameter($parameter);
        return Inertia::render('Digimon/index', [
            'parameter' => $parameter,
            'digimons' => $digimons,
        ]);
    }
}
