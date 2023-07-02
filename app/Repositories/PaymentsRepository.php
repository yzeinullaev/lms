<?php

namespace App\Repositories;

use App\Models\Payment;
use App\Repositories\Eloquent\BaseRepository;
use Illuminate\Database\Eloquent\Collection;

class PaymentsRepository extends BaseRepository
{
    public function __construct(Payment $model)
    {
        parent::__construct($model);
    }

    /**
     * @param int $id
     * @return Collection|array
     */
    public function getByTypeAndId(int $id): Collection|array
    {
        return $this->model->query()
            ->where('id', $id)
            ->where('status', 0)
            ->get();
    }

    /**
     * @return Collection|array
     */
    public function getByTypeAll(): Collection|array
    {
        return $this->model->query()
            ->where('status', '0')
            ->get();
    }

    /**
     * @param $data
     * @return array
     */
    public function newPayment($data): array
    {
        return $this->create([
            'user_id' => $data['user_id'],
            'course_id' => $data['course_id'],
            'tariff_id' => $data['tariff_id'],
            'amount' => $data['amount'],
            'language' => $data['language'],
            'currency' => $data['currency'],
        ])->toArray();
    }

    /**
     * @param $id
     * @param $data
     * @return mixed
     */
    public function updatePayment($id, $data): mixed
    {
        return $this->update($id, [
            'user_id' => $data['user_id'],
            'course_id' => $data['course_id'],
            'tariff_id' => $data['tariff_id'],
            'amount' => $data['amount'],
        ]);
    }
}
