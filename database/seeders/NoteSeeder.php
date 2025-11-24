<?php

namespace Database\Seeders;

use App\Models\Note;
use App\Models\User;
use Illuminate\Database\Seeder;

class NoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil user pertama atau buat jika belum ada
        $user = User::first();
        
        if (!$user) {
            $this->command->info('No users found. Please run UserSeeder first.');
            return;
        }

        $notes = [
            [
                'title' => 'Catatan Kuliah Pemrograman Web',
                'content' => "# Laravel Framework\n\n- MVC Pattern\n- Eloquent ORM\n- Blade Templating\n- Routing System\n- Middleware\n\n## Tugas Minggu Ini:\n- Buat CRUD sederhana\n- Deploy ke hosting",
                'category' => 'kuliah',
            ],
            [
                'title' => 'Ide Proyek Akhir Semester',
                'content' => "Aplikasi Manajemen Tugas untuk Mahasiswa\n\nFitur:\n- Dashboard analytics\n- Kalender akademik\n- Reminder otomatis\n- Kolaborasi kelompok\n- Export data",
                'category' => 'kuliah',
            ],
            [
                'title' => 'Catatan Database',
                'content' => "# Normalisasi Database\n\n1NF - Atomic values\n2NF - No partial dependency\n3NF - No transitive dependency\n\nContoh:\nMahasiswa(id, nama, nim)\nMatakuliah(id, kode, nama)\nNilai(mahasiswa_id, matakuliah_id, nilai)",
                'category' => 'kuliah',
            ],
            [
                'title' => 'Daftar Buku Bacaan',
                'content' => "Buku yang harus dibaca:\n\n1. Clean Code - Robert C. Martin\n2. Design Patterns - Gang of Four\n3. The Pragmatic Programmer\n4. Laravel Up & Running - Matt Stauffer",
                'category' => 'personal',
            ],
        ];

        foreach ($notes as $noteData) {
            Note::create([
                'user_id' => $user->id,
                'title' => $noteData['title'],
                'content' => $noteData['content'],
                'category' => $noteData['category'],
            ]);
        }

        $this->command->info('Notes seeded successfully!');
    }
}
