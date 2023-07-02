<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\LangRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\ErrorCodes;
use App\Models\User;
use App\Services\UserService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;

class UserApiController extends Controller
{

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    /**
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $requestData = $request->validated();

        try {
            return $this->response($this->service->login($requestData));
        } catch (Exception $e) {
            return $this->error($e->getMessage(), $e->getTrace());
        }
    }

    /**
     * @param LangRequest $request
     * @return JsonResponse
     */
    public function logout(LangRequest $request): JsonResponse
    {
        $requestData = $request->validated();

        try {
            return $this->response($this->service->logout($requestData));
        } catch (Exception $e) {
            return $this->error($e->getMessage(), $e->getTrace());
        }
    }

    /**
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function registration(RegisterRequest $request): JsonResponse
    {

        $check_user = User::where('email', $request['email'])->first();

        if ($check_user) {
            return response()->json([
                'message' => 'Пользователь уже существует'
            ], 400);
        }

        try {
            $user = User::create([
                'name' => $request['name'],
                'phone' => $request['phone'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
            ]);

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'data' => $user,
                'access_token' => $token,
            ], 201);

        } catch (Exception $e) {
            return response()->json('Ошибка при сохранении, ' . $e->getMessage());
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function changePassword(Request $request): JsonResponse
    {
        $token = PersonalAccessToken::findToken(request()->bearerToken());

        if (isset($token)) {

            $user = User::findOrFail($token->tokenable_id);

            if (isset($user)) {

                $user->password = Hash::make($request['password']);
                $user->save();

                return response()->json([
                    'message' => ErrorCodes::where('code', 'password changed')->first()->getMessage->{$request->lang} ?? "Password changed",
                ]);

            } else {

                return response()->json([
                    'message' => ErrorCodes::where('code', 'code incorrect')->first()->getMessage->{$request->lang} ?? "Code incorrect",
                ], 400);
            }
        } else {

            return response()->json([
                'message' => ErrorCodes::where('code', 'code incorrect')->first()->getMessage->{$request->lang} ?? "Code incorrect",
            ], 400);
        }
    }


    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function userInfo(Request $request): JsonResponse
    {
        try {
            return $this->response($this->service->userAuthInfo($request->all()));
        } catch (Exception $e) {
            return $this->error($e->getMessage(), $e->getTrace());
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function unsubscribe(Request $request): JsonResponse
    {
        $userId = Auth::user()->getAuthIdentifier();

        try {
            return $this->response($this->service->unsubscribeNews($userId));
        } catch (Exception $e) {
            return $this->error($e->getMessage(), $e->getTrace());
        }
    }
}
