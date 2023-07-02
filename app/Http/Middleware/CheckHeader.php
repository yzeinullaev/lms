<?php

namespace App\Http\Middleware;

use App\Enums\ConstantEnum;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CheckHeader
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param \Closure(Request): (Response|RedirectResponse) $next
     * @return RedirectResponse|Response|mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        if ($request->hasHeader('Accept-Language')) {
            $request->merge(['lang' => $request->header('Accept-Language')]);
        } else {
            $request->merge(['lang' => ConstantEnum::DEFAULT_LANG]);
        }

        return $next($request);
    }
}
