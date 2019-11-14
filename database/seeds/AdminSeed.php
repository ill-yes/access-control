<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class AdminSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        do {
            $pin = mt_rand(1000, 9999);
        } while (!is_null(User::where('pin', $pin)->first()));

        $user = User::create([
            'name' => 'Malte Jesgarzewsky',
            'email' => 'malte.jesgarzewsky@uni-kassel.de',
            'password' => Hash::make('abcD123!'),
            'pin' => $pin,
            'admin' => true,
            'card_number' => '161581122'
        ]);
    }
}
