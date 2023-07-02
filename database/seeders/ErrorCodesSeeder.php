<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\Models\ErrorCodes;
use App\Models\Translate;

class ErrorCodesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $errorCodes = [
            [
                'code'=> 'success',
                'message'=>Translate::insertGetId(
                    [
                        'ru' => 'Успешно!',
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]
                ),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'code'=> 'error',
                'message'=>Translate::insertGetId(
                    [
                        'ru' => 'Ошибка!',
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]
                ),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'code'=> 'unauthorized',
                'message'=>Translate::insertGetId(
                    [
                        'ru' => 'Не авторизрван!',
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]
                ),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ];

        ErrorCodes::insert($errorCodes);
    }
}
