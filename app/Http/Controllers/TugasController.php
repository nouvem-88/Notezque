<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TugasController extends Controller
{
    private $tasks = [];

    public function __construct()
    {
        // Initialize dummy data
        $this->tasks = [
            [
                'id' => 1,
                'title' => 'Tugas Pendahuluan',
                'status' => 'Open',
                'matkul' => 'WebPro',
                'tenggat' => '2025-06-21',
                'keterangan' => 'Membuat halaman sesuai pembagian masing-masing anggota kelompok.'
            ],
            [
                'id' => 2,
                'title' => 'Tugas Praktek PHP',
                'status' => 'In Progress',
                'matkul' => 'WebPro',
                'tenggat' => '2025-06-21',
                'keterangan' => 'Mengerjakan fungsionalitas masing-masing anggota kelompok.'
            ],
            [
                'id' => 3,
                'title' => 'Laporan Akhir',
                'status' => 'Selesai',
                'matkul' => 'Manajemen Proyek',
                'tenggat' => '2025-06-20',
                'keterangan' => 'Menyusun laporan akhir proyek dan presentasi.'
            ]
        ];

        // Store tasks in session if not exists
        if (!session()->has('tasks')) {
            session(['tasks' => $this->tasks]);
        }
    }

    public function index()
    {
        $tasks = session('tasks', []);
        return view('pages.kelola-tugas', compact('tasks'));
    }

    public function store(Request $request)
    {
        $tasks = session('tasks', []);

        $newTask = [
            'id' => count($tasks) + 1,
            'title' => $request->nama_tugas,
            'status' => 'Open',
            'matkul' => $request->matkul ?? 'Default Matkul',
            'tenggat' => $request->tenggat ?? date('Y-m-d', strtotime('+1 week')),
            'keterangan' => $request->detail_tugas
        ];

        $tasks[] = $newTask;
        session(['tasks' => $tasks]);

        return redirect()->back()->with('success', 'Tugas berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $tasks = session('tasks', []);

        foreach ($tasks as $key => $task) {
            if ($task['id'] == $id) {
                // --- PERUBAHAN DI SINI ---
                $tasks[$key]['title'] = $request->nama_tugas;
                $tasks[$key]['status'] = $request->status;
                $tasks[$key]['keterangan'] = $request->keterangan;
                $tasks[$key]['matkul'] = $request->matkul;     // <-- Tambahkan baris ini
                $tasks[$key]['tenggat'] = $request->tenggat;   // <-- Tambahkan baris ini
                // -------------------------
                break;
            }
        }

        session(['tasks' => $tasks]);
        return redirect()->back()->with('success', 'Tugas berhasil diperbarui');
    }

    public function destroy($id)
    {
        $tasks = session('tasks', []);

        $tasks = array_filter($tasks, function ($task) use ($id) {
            return $task['id'] != $id;
        });

        session(['tasks' => array_values($tasks)]);
        return redirect()->back()->with('success', 'Tugas berhasil dihapus');
    }
}