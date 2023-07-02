<?php

namespace Database\Seeders;

use App\Models\Language;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        User::factory(10)->create();

        User::factory()->create([
            'name' => 'Administrator',
            'email' => 'admin@demo.com',
            'phone' => '00000000000',
            'password' => Hash::make('Dtnthievbn9586'),
            'role_id' => 1
        ]);

        Language::create([
            'slug' => 'ru',
            'name' => 'Русский',
        ]);

        $this->call([
            ErrorCodesSeeder::class,
        ]);

        Review::factory(3)->create();
    }
}
