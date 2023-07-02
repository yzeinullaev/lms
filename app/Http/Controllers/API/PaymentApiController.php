<?php

namespace App\Http\Controllers\API;

use App\Enums\PaymentEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentRequest;
use App\Services\PaymentService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PaymentApiController extends Controller
{

    public function __construct(PaymentService $service)
    {
        $this->service = $service;
    }

    /**
     * @param PaymentRequest $request
     * @return JsonResponse|null
     */
    public function payment(PaymentRequest $request): ?JsonResponse
    {
        try {
            return $this->response($this->service->payment($request->all()));
        } catch (Exception $e) {
            return $this->error($e->getMessage(), $e->getTrace());
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function paymentSuccess(Request $request): JsonResponse
    {
        $request->merge(['status' => PaymentEnum::PAYED]);

        try {
            return $this->response($this->service->result($request->all()));
        } catch (Exception $e) {
            return $this->error($e->getMessage(), $e->getTrace());
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function paymentFailed(Request $request): JsonResponse
    {
        $request->merge(['status' => PaymentEnum::FAILED]);

        try {
            return $this->response($this->service->result($request->all()));
        } catch (Exception $e) {
            return $this->error($e->getMessage(), $e->getTrace());
        }
    }
}
