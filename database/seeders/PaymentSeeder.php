<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentSeeder extends Seeder
{
    public function run(): void
    {
        // Kosongkan tabel terlebih dahulu
        DB::table('payments')->delete();

        // Siapkan data metode pembayaran
        $payments = [
            [
                'name' => 'QRIS',
                'description' => 'Pembayaran melalui pindai kode QR. Mendukung semua e-wallet (GoPay, OVO, Dana, dll) dan m-banking.',
                'is_active' => true,
            ],
            [
                'name' => 'Cash',
                'description' => 'Bayar tunai langsung kepada kasir saat',
                'is_active' => true,
            ],
            [
                'name' => 'Bank Transfer (BCA)',
                'description' => 'Transfer manual ke rekening Virtual Account BCA kami. Instruksi akan diberikan saat checkout.',
                'is_active' => false,
            ],
            [
                'name' => 'Credit / Debit Card',
                'description' => 'Pembayaran aman menggunakan kartu kredit atau debit Visa, MasterCard, dan lainnya.',
                'is_active' => false,
            ],
        ];

        // Tambahkan timestamp untuk setiap item sebelum insert
        $timestamp = now();
        foreach ($payments as &$payment) {
            $payment['created_at'] = $timestamp;
            $payment['updated_at'] = $timestamp;
        }

        // Insert data ke database
        DB::table('payments')->insert($payments);
    }
}
