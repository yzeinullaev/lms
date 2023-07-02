<?php

declare(strict_types=1);

namespace App\Services;


use App\Enums\ConstantEnum;
use App\Enums\PaymentEnum;
use App\Repositories\PaymentsRepository;
use App\Repositories\SubscriptionsRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Storage;

class PaymentService
{
    /**
     * @param PaymentsRepository $repository
     * @param CourseService $courseService
     * @param TariffService $tariffService
     * @param UserService $userService
     * @param SubscriptionsRepository $subscriptionsRepository
     * @param EPayService $payService
     */
    public function __construct(private PaymentsRepository  $repository,
                                private CourseService       $courseService,
                                private TariffService       $tariffService,
                                private UserService         $userService,
                                private SubscriptionsRepository $subscriptionsRepository,
                                private EPayService         $payService,
    )
    {
    }

    /**
     * @param array $data
     * @return array
     * @throws Exception
     */
    public function payment(array $data): array
    {
        list($courseId, $tariffId, $lang) = array_values($data);

        $courseData = $this->courseService->getById(intval($courseId), $lang)->first();
        $tariffData = $this->tariffService->getById(intval($tariffId), $lang)->first();
        $userData = $this->userService->userAuthInfo($data);

        if ($tariffData['buy_soon'] === 1) {
            throw new Exception('Тариф не активен');
        }

        $payment = $this->repository->create([
            'user_id' => $userData['id'],
            'course_id' => $courseData['id'],
            'tariff_id' => $tariffData['id'],
            'amount' => $tariffData['price'],
            'language' => $lang,
            'description' => self::getDesc($courseData, $tariffData),
            'currency' => PaymentEnum::DEFAULT_CURRENCY,
            'status' => PaymentEnum::NEW,
        ]);

        $request = [
            'batch' => self::getBatch($payment->id),
            'amount' => $payment->amount, //todo: нужен расчет как аписано в тз.
            'currency' => $payment->currency,
            'language' => $payment->language,
            'description' => $payment->description,
            'phone' => $userData['phone'],
            'email' => $userData['email'],
        ];

        $this->repository->update($payment->id, [
            'request' => json_encode($request),
        ]);

        $getData = self::ePay($request);

        if ($getData['status'] !== 200) {
            throw new Exception($getData['data']);
        }

        Storage::disk('public')->put('payment.html', $getData['data']);

        return [
            "pay_link" => url(asset("/storage/payment.html"))
        ];
    }

    /**
     * @param array $data
     * @return array
     */
    private function ePay(array $data): array
    {
        return $this->payService->gateway(
            config('payment.test'),
            config('payment.client_id'),
            config('payment.client_secret'),
            config('payment.terminal'),
            $data['batch'],
            $data['amount'],
            $data['currency'],
            config('payment.front_back_link'),
            config('payment.front_failed_back_link'),
            config('payment.post_link'),
            config('payment.failed_post_link'),
            $data['language'],
            $data['description'],
            config('payment.account_id'),
            $data['phone'],
            $data['email']);
    }

    /**
     * @param array $data
     * @return string
     * @throws Exception
     */
    public function result(array $data): string
    {
        $paymentId = intval(ltrim($data['invoice_id'], "0"));
        $paymentData = $this->getById($paymentId)->first();
        $startSubscribe = Carbon::now();
        $endSubscribe = $startSubscribe->clone()->addDays(PaymentEnum::DEFAULT_SUBSCRIBE);

        try {
            $this->repository->update($paymentId, [
                'status' => $data['status'],
                'response' => json_encode($data),
            ]);

            $this->subscriptionsRepository->create([
                'user_id' => $paymentData['user_id'],
                'course_id' => $paymentData['course_id'],
                'tariff_id' => $paymentData['tariff_id'],
                'payment_id' => $paymentId,
                'start_subscribe' => $startSubscribe,
                'end_subscribe' => $endSubscribe,
            ]);

            return PaymentEnum::PAYMENT_SUCCESS;

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @param array $courseData
     * @param array $tariffData
     * @return string
     * @throws Exception
     */
    protected function getDesc(array $courseData, array $tariffData): string
    {
        if (empty($courseData) && empty($tariffData)) {
            throw new Exception('Нет данных для описания оплаты!');
        }

        return 'Курс: ' . $courseData['name'] . ', Тариф: ' . $tariffData['name'];
    }

    /**
     * @param int $subscribeId
     * @return string
     * @throws Exception
     */
    protected function getBatch(int $subscribeId): string
    {
        if (!$subscribeId) {
            throw new Exception('Нет данных для Invoice_id оплаты!');
        }

        if (strlen((string)$subscribeId) < 6) {
            return str_pad((string)$subscribeId, 6, "0", STR_PAD_LEFT);
        } else {
            return (string)$subscribeId;
        }
    }

    /**
     * @param int $id
     * @param string $lang
     * @return mixed
     */
    public function getById(int $id, string $lang = ConstantEnum::DEFAULT_LANG): mixed
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
                'course_id' => $item->course_id,
                'tariff_id' => $item->tariff_id,
                'user_id' => $item->user_id,
                'amount' => $item->amount,
                'language' => $item->language,
                'description' => $item->description,
                'currency' => $item->currency,
                'request' => $item->request,
                'status' => $item->status,
                'response' => $item->response,
            ];
        });
    }

}
