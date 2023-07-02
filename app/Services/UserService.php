<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\UserEnum;
use App\Repositories\ErrorCodeRepository;
use App\Repositories\UserRepository;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class UserService
{
    /**
     * @param UserRepository $repository
     * @param ErrorCodeRepository $errorCodeRepository
     * @param SubscriptionService $subscriptionService
     * @param ReviewService $reviewService
     * @param NotificationService $notificationService
     */
    public function __construct(
        private UserRepository $repository,
        private ErrorCodeRepository $errorCodeRepository,
        private SubscriptionService $subscriptionService,
        private ReviewService $reviewService,
        private NotificationService $notificationService,
    ) {
    }

    /**
     * @param array $request
     * @return array
     * @throws Exception
     */
    public function login(array $request): array
    {
        try {
            if (!Auth::attempt($request)) {
                throw new Exception('Неверный пароль');
            }

            return [
                'access_token' => Auth::user()->createToken('authToken')->plainTextToken
            ];

        } catch (Exception $th) {
            throw new Exception($th->getMessage());
        }
    }

    /**
     * @param array $request
     * @return array
     * @throws Exception
     */
    public function logout(array $request): array
    {
        try {
            Auth::user()->tokens()->delete();

            return [
                'message' => $this->errorCodeRepository->getMessage('logout', $request['lang'])
            ];

        } catch (Exception $th) {
            throw new Exception($th->getMessage());
        }
    }

    /**
     * @param array $data
     * @return array
     * @throws Exception
     */
    public function userAuthInfo(array $data = []): array
    {
        $user = Auth::user();

        if (!$user->getAuthIdentifier()) {
            throw new Exception('Пользователь не найден!');
        }

        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
            'role' => $user->role_id,
            'sex' => UserEnum::SEX[$user->sex],
            'subscribe' => $this->subscriptionService->getByUserId($user->id, $data['lang']),
            'reviews' => $this->reviewService->getByUserId($user->id, $data['lang']),
            'notifications' => [
                'user' => $this->notificationService->getByUserId($user->id, $data['lang']),
                'all' => $this->notificationService->getAll($data['lang']),
            ]
        ];
    }


    public function getById(int $id, string $lang)
    {
        if ($id === 0) {
            return self::dataMapping($this->repository->getByTypeAll(), $lang);
        }

        return self::dataMapping($this->repository->getByTypeAndId($id), $lang);
    }

    /**
     * @param $items
     * @param string $lang
     * @return mixed
     */
    protected function dataMapping($items, string $lang): mixed
    {
        return $items->map(function ($item) use ($lang) {
            return [
                'id' => $item->id,
                'name' => $item->name,
                'email' => $item->email,
                'phone' => $item->phone,
            ];
        });
    }

    /**
     * @return Collection|array
     */
    public function getUserWithNewsNotification(): Collection|array
    {
        return $this->repository->getWithNewsNotification();
    }

    /**
     * @param int $userId
     * @return mixed
     */
    public function unsubscribeNews(int $userId): mixed
    {
        return $this->repository->update($userId, [
            'news_notification' => false
        ]);
    }

}
