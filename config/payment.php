<?php

return [
    'test' => env('EPAY_TEST') ?? null,
    'client_id' => env('EPAY_CLIENT_ID'),
    'client_secret' => env('EPAY_CLIENT_SECRET'),
    'terminal' => env('EPAY_TERMINAL'),
    'front_back_link' => env('EPAY_FRONT_BACK_LINK'),
    'front_failed_back_link' => env('EPAY_FRONT_FAILED_BACK_LINK'),
    'post_link' => env('EPAY_POST_LINK'),
    'failed_post_link' => env('EPAY_FAILED_POST_LINK'),
    'account_id' => env('EPAY_ACCOUNT_ID'),
];
