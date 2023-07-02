<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReviewStoreRequest;
use App\Services\ReviewService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewApiController extends Controller
{
    /**
     * @param ReviewService $service
     */
    public function __construct(private ReviewService $service)
    {
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getByUser(Request $request): JsonResponse
    {
        $userId = Auth::user()->getAuthIdentifier();

        try {
            return $this->response($this->service->getByUserId($userId, $request->lang));
        } catch (Exception $e) {
            return $this->error($e->getMessage(), $e->getTrace());
        }
    }

    public function create(ReviewStoreRequest $request): JsonResponse
    {
        $request->merge([
            'user_id' => Auth::user()->getAuthIdentifier()
        ]);

        try {
            return $this->response($this->service->create($request->all()));
        } catch (Exception $e) {
            return $this->error($e->getMessage(), $e->getTrace());
        }
    }
}
