<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PendaftarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Data profil yang berbeda-beda untuk setiap pendaftar
        $profiles = [
            [
                'nm_pendaftar' => 'John Doe',
                'alamat' => 'Jl. Contoh No. 123',
                'jenis_kelamin' => 'Laki-laki',
                'no_hp' => '08123456789',
                'asal_sekolah' => 'SMA Contoh',
                'jurusan' => 'RPL',
                'tgl_lahir' => '2000-01-01',
                'nisn' => '1234567890',
            ],
            [
                'nm_pendaftar' => 'Jane Smith',
                'alamat' => 'Jl. Contoh No. 456',
                'jenis_kelamin' => 'Perempuan',
                'no_hp' => '08123456788',
                'asal_sekolah' => 'SMA Contoh',
                'jurusan' => 'TKJ',
                'tgl_lahir' => '2000-02-02',
                'nisn' => '1234567891',
            ],
            // Tambahkan data profil lainnya sesuai kebutuhan
        ];

        // Memasukkan data profil ke dalam database
        foreach ($profiles as $profile) {
            DB::table('pendaftar')->insert([
                'nm_pendaftar' => $profile['nm_pendaftar'],
                'alamat' => $profile['alamat'],
                'jenis_kelamin' => $profile['jenis_kelamin'],
                'no_hp' => $profile['no_hp'],
                'asal_sekolah' => $profile['asal_sekolah'],
                'jurusan' => $profile['jurusan'],
                'tgl_lahir' => $profile['tgl_lahir'],
                'nisn' => $profile['nisn'],
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
