<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\TranslateRepository;

class TranslateService
{
    /**
     * @param TranslateRepository $repository
     */
    public function __construct(
        private TranslateRepository $repository,
    ) {
    }


}
