<?php

namespace App\Repositories;


use App\Models\Subscription;
use App\Repositories\Eloquent\BaseRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class SubscriptionsRepository extends BaseRepository
{
    public function __construct(Subscription       $model,
                                TariffsRepository  $tariffsRepository,
                                CourseRepository   $courseRepository,
                                UserRepository     $userRepository,
                                PaymentsRepository $paymentsRepository,
    )
    {
        $this->tariffsRepository = $tariffsRepository;
        $this->courseRepository = $courseRepository;
        $this->userRepository = $userRepository;
        $this->paymentsRepository = $paymentsRepository;
        parent::__construct($model);
    }

    /**
     * @param int $id
     * @return Collection|array
     */
    public function getByTypeAndId(int $id): Collection|array
    {
        return $this->model->query()
            ->with(['getCourse', 'getTariff', 'getUser', 'getPayment'])
            ->where('id', $id)
            ->where('payment_status', '0')
            ->get();
    }

    /**
     * @return Collection|array
     */
    public function getByTypeAll(): Collection|array
    {
        return $this->model->query()
            ->with(['getCourse', 'getTariff', 'getUser', 'getPayment'])
            ->where('payment_status', '0')
            ->get();
    }

    /**
     * @param int $userId
     * @return Collection|array
     */
    public function getByUserId(int $userId): Collection|array
    {
        return $this->model->query()
            ->with(['getCourse', 'getTariff', 'getUser', 'getPayment'])
            ->where('user_id', $userId)
            ->where('payment_status', '1')
            ->whereDate('end_subscribe', '>=', Carbon::now())
            ->get();
    }

    /**
     * @return Collection|array
     */
    public function getAllTariffs(): Collection|array
    {
        return $this->tariffsRepository->getByTypeAll();
    }

    /**
     * @return Collection|array
     */
    public function getAllCourses(): Collection|array
    {
        return $this->courseRepository->getByTypeAll();
    }

    /**
     * @return Collection|array
     */
    public function getAllUsers(): Collection|array
    {
        return $this->userRepository->getByTypeAll();
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function cretePayment(array $data): mixed
    {
        $data = [
            'user_id' => $data['user_id'],
            'course_id' => $data['course_id'],
            'tariff_id' => $data['tariff_id'],
            'amount' => $data['payment'],
            'language' => 'RU',
            'currency' => 'KZT'
        ];

        $payment = $this->paymentsRepository->newPayment($data);

        return $payment['id'];
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function updatePayment(array $data): mixed
    {
        $item = [
            'user_id' => $data['user_id'],
            'course_id' => $data['course_id'],
            'tariff_id' => $data['tariff_id'],
            'amount' => $data['payment'],
        ];

        return $this->paymentsRepository->updatePayment($data['payment_id'], $item);
    }

}
