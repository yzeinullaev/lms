<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\PageRequest;
use App\Services\PageService;
use Illuminate\Http\JsonResponse;

class PageApiController extends Controller
{

    public function __construct(PageService $service)
    {
        $this->service = $service;
    }

    /**
     * @param PageRequest $request
     * @return JsonResponse
     */
    public function getBySlug(PageRequest $request): JsonResponse
    {
        return $this->response($this->service->getPageBySlug($request->slug, $request->child_slug, $request->lang));
    }
}
