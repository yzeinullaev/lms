<?php

namespace App\Http\Middleware;

use App\Services\RequestResponseAPILoggerService;
use Closure;
use Illuminate\Http\Request;

class LogIncomingAPIRequest
{
    private RequestResponseAPILoggerService $logger;

    public function __construct(RequestResponseAPILoggerService $logger)
    {
        $this->logger = $logger;
    }

    private const PAYMENT_SUCCESS = 'paymentSuccess';
    private const PAYMENT_FAILED = 'paymentFailed';
    private const PAYMENT = 'payment';

    /**
     * @var string[] controller with actions which need to log only on errors
     */
    private const LOG_ROUTE_NAMES = [
        self::PAYMENT_SUCCESS,
        self::PAYMENT_FAILED,
        self::PAYMENT,
    ];

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        $response = $next($request);

        try {
            $controller = $request->route()->action['controller'];

            if (in_array($request->route()->getName(), self::LOG_ROUTE_NAMES)) {

                $method = $request->getMethod();

                $data = [
                    'method'        => $method,
                    'url'           => $request->getUri(),
                    'params'        => $request->toArray(),
                    'headers'       => $request->headers->all(),
                    'status_code'   => $response->status(),
                    'response'      => @json_encode(json_decode($response->content(), true), JSON_UNESCAPED_UNICODE),
                    'incoming'      => 1,
                ];

                $this->logger->log($data, $controller);
            }
        } catch (\Throwable $e) {
        }

        return $response;
    }
}
