<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\Note;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed konten statis
        $this->call([
            KontenStatisSeeder::class,
        ]);

        // Create default user
        $user = User::create([
            'name' => 'User NotezQu',
            'email' => 'user@notezque.test',
            'password' => Hash::make('password123'),
        ]);


        // Create sample notes for user
        $user->notes()->createMany([
            [
                'title' => 'Catatan Pertama',
                'content' => 'Ini adalah catatan pertama saya di Notezque.',
                'category' => 'personal',
            ],
            [
                'title' => 'Ide Proyek',
                'content' => 'Membuat aplikasi manajemen tugas dengan Laravel.',
                'category' => 'work',
            ],
            [
                'title' => 'Daftar Belanja',
                'content' => 'Beras, Telur, Sayur-sayuran',
                'category' => 'personal',
            ],
        ]);

        // Create sample tasks for user
        $user->tasks()->createMany([
            [
                'title' => 'Tugas Pendahuluan',
                'description' => 'Membuat halaman sesuai pembagian masing-masing anggota kelompok.',
                'due_date' => '2025-06-21',
                'priority' => 'high',
                'status' => 'pending',
            ],
            [
                'title' => 'Tugas Praktek PHP',
                'description' => 'Mengerjakan fungsionalitas masing-masing anggota kelompok.',
                'due_date' => '2025-06-21',
                'priority' => 'medium',
                'status' => 'pending',
            ],
            [
                'title' => 'Laporan Akhir',
                'description' => 'Menyusun laporan akhir proyek dan presentasi.',
                'due_date' => '2025-06-20',
                'priority' => 'high',
                'status' => 'completed',
                'completed_at' => now(),
            ],
        ]);

        // Create sample activities for user
        $user->activities()->createMany([
            [
                'title' => 'Rapat Tim Proyek',
                'desk' => 'Membahas progres proyek mingguan.',
                'date' => '2025-11-18',
                'time' => '10:00',
                'reminder' => '15m',
                'status' => 'pending',
            ],
            [
                'title' => 'Presentasi Klien',
                'desk' => 'Demo produk untuk klien.',
                'date' => '2025-11-20',
                'time' => '14:30',
                'reminder' => '1h',
                'status' => 'pending',
            ],
            [
                'title' => 'Waktu Fokus Coding',
                'desk' => 'Menyelesaikan fitur A.',
                'date' => '2025-11-22',
                'time' => '',
                'reminder' => 'none',
                'status' => 'done',
            ],
        ]);

        $this->call(AdminSeeder::class);
    }
}
