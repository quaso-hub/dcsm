<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::create([
            'first_name' => 'Super',
            'last_name'  => 'Admin',
            'email'      => 'admin@example.com',
            'password'   => Hash::make('password'),
        ]);

        $admin->assignRole('admin');

        $adminWallet = Wallet::create([
            'user_id' => $admin->id,
            'balance' => 200000,
        ]);

        WalletTransaction::create([
            'wallet_id' => $adminWallet->id,
            'type'      => 'in',
            'label'     => 'Modal Awal Sistem',
            'amount'    => 200000,
            'date'      => Carbon::parse('2025-06-15'),
        ]);

        $customer = User::create([
            'first_name' => 'John',
            'last_name'  => 'Doe',
            'email'      => 'customer@example.com',
            'password'   => Hash::make('password'),
        ]);

        $customer->assignRole('customer');

        $customerWallet = Wallet::create([
            'user_id' => $customer->id,
            'balance' => 120000,
        ]);

        WalletTransaction::insert([
            [
                'wallet_id' => $customerWallet->id,
                'type'      => 'in',
                'label'     => 'Top Up via Transfer',
                'amount'    => 50000,
                'date'      => Carbon::parse('2025-06-26'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'wallet_id' => $customerWallet->id,
                'type'      => 'out',
                'label'     => 'Pembayaran Pesanan #INV12345',
                'amount'    => 28000,
                'date'      => Carbon::parse('2025-06-25'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'wallet_id' => $customerWallet->id,
                'type'      => 'in',
                'label'     => 'Cashback Promo',
                'amount'    => 10000,
                'date'      => Carbon::parse('2025-06-20'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
