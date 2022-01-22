<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WalletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('wallets')->insert([
            [
                'user_id' => 1,
                'currency_id' => 1,
                'available_amount' => 10000.00,
                'status' => 'active',
            ],
            [
                'user_id' => 1,
                'currency_id' => 2,
                'available_amount' => 10000.00,
                'status' => 'active',
            ]
        ]);
    }
}
