<?php

namespace App\Http\Controllers;

use App\Http\Resources\CompanyResource;
use App\Services\CompanyService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CompanyController extends Controller
{
    public function __construct(private CompanyService $service)
    {

    }

    public function index(Request $request): AnonymousResourceCollection
    {
        return CompanyResource::collection($this->service->getByUser($request->user()));
    }

    public function store(Request $request): CompanyResource
    {
        $this->validate($request, [
            'title'       => ['required', 'string', 'unique:companies,title'],
            'phone'       => ['required', 'string', 'unique:companies,phone'],
            'description' => ['sometimes', 'string', 'nullable'],
        ]);

        return new CompanyResource($this->service->createAndAssign($request->user(), $request->all()));
    }
}
