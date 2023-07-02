<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\CourseService;

class CourseApiController extends Controller
{

    public function __construct(CourseService $service)
    {
        $this->service = $service;
    }
}
