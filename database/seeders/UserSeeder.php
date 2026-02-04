<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // ======================
        // ADMIN
        // ======================
        User::updateOrCreate(
            ['email' => 'admin1571@bps.go.id'],
            [
                'name' => 'Administrator',
                'role' => 'admin',
                'password' => Hash::make('admin1571'),
            ]
        );
        User::updateOrCreate(
            ['email' => 'sasria@bps.go.id'],
            [
                'name' => 'Hery Sasria',
                'role' => 'admin',
                'password' => Hash::make('12345678'),
            ]
        );

        // ======================
        // PENANGGUNG JAWAB TIM
        // ======================
        User::updateOrCreate(
            ['email' => 'budik@bps.go.id'],
            [
                'name' => 'Budi Kurniawan',
                'role' => 'pj',
                'password' => Hash::make('12345678'),
            ]
        );
        User::updateOrCreate(
            ['email' => 'kelik.heri@bps.go.id'],
            [
                'name' => 'Kelik Heri Purnomo',
                'role' => 'pj',
                'password' => Hash::make('12345678'),
            ]
        );
        User::updateOrCreate(
            ['email' => 'diah.sari@bps.go.id'],
            [
                'name' => 'Diah Pravita Sari',
                'role' => 'pj',
                'password' => Hash::make('12345678'),
            ]
        );
        User::updateOrCreate(
            ['email' => 'kiky.amci@bps.go.id'],
            [
                'name' => 'Kiky Amci Ilzania',
                'role' => 'pj',
                'password' => Hash::make('12345678'),
            ]
        );
        User::updateOrCreate(
            ['email' => 'isna.rahayu@bps.go.id'],
            [
                'name' => 'Isna Rahayu',
                'role' => 'pj',
                'password' => Hash::make('12345678'),
            ]
        );
        User::updateOrCreate(
            ['email' => 'rizon@bps.go.id'],
            [
                'name' => 'Afrizon',
                'role' => 'pj',
                'password' => Hash::make('12345678'),
            ]
        );
        User::updateOrCreate(
            ['email' => 'wulanagusp@bps.go.id'],
            [
                'name' => 'Wulan Agus Pramita Sari',
                'role' => 'pj',
                'password' => Hash::make('12345678'),
            ]
        );
        User::updateOrCreate(
            ['email' => 'dhira.fajri@bps.go.id'],
            [
                'name' => 'Dhira Fajri Atika',
                'role' => 'pj',
                'password' => Hash::make('12345678'),
            ]
        );
        User::updateOrCreate(
            ['email' => 'ardanayu@bps.go.id'],
            [
                'name' => 'Ardana Yulmiroza Utari',
                'role' => 'pj',
                'password' => Hash::make('12345678'),
            ]
        );
        User::updateOrCreate(
            ['email' => 'wijay@bps.go.id'],
            [
                'name' => 'Wijayanti Agustini',
                'role' => 'pj',
                'password' => Hash::make('12345678'),
            ]
        );
        User::updateOrCreate(
            ['email' => 'benny@bps.go.id'],
            [
                'name' => 'Benny Kristiyan Ardy',
                'role' => 'pj',
                'password' => Hash::make('12345678'),
            ]
        );
        User::updateOrCreate(
            ['email' => 'ari.hidayat@bps.go.id'],
            [
                'name' => 'Ari Hidayat',
                'role' => 'pj',
                'password' => Hash::make('12345678'),
            ]
        );
    }
}
