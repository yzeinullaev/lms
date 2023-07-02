<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApplicationStoreRequest;
use App\Services\MailService;
use Exception;
use Illuminate\Http\JsonResponse;

class ApplicationApiController extends Controller
{
    /**
     * @param MailService $service
     */
    public function __construct(private MailService $service)
    {
    }

    /**
     * @param ApplicationStoreRequest $request
     * @return JsonResponse
     */
    public function sendApplication(ApplicationStoreRequest $request): JsonResponse
    {
        try {
            return $this->response($this->service->sendForm($request->all()));
        } catch (Exception $e) {
            return $this->error($e->getMessage(), $e->getTrace());
        }
    }
}
