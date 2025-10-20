<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class KalenderController extends Controller
{
    /**
     * Mengambil data aktivitas dari session atau menginisialisasi dengan data mock.
     */
    private function getAktivitas()
    {
        return Session::get('mock_aktivitas', config('users.aktivitas'));
    }

    /**
     * Menampilkan halaman kalender utama.
     */
    public function index(Request $request)
    {
        $bulan_filter = (int) $request->get('bulan', date('n'));
        $tahun_filter = (int) $request->get('tahun', date('Y'));
        $sort = $request->get('sort', 'date_asc');

        // Ambil data dari session
        $all_aktivitas = $this->getAktivitas();

        // Filter acara untuk bulan yang sedang dilihat (untuk sidebar list)
        $aktivitasBulanIni = collect($all_aktivitas)
            ->filter(function ($item) use ($bulan_filter, $tahun_filter) {
                $date = \DateTime::createFromFormat('Y-m-d', $item['date']);
                if (!$date) return false;
                return $date->format('n') == $bulan_filter && $date->format('Y') == $tahun_filter;
            });

        // Apply sorting based on request
        $now = now(); // Tanggal dan waktu sekarang
        
        switch ($sort) {
            case 'date_asc':
                // Tanggal Terdekat: Sort berdasarkan jarak absolut dari sekarang (yang paling dekat duluan)
                $aktivitasBulanIni = $aktivitasBulanIni->sort(function ($a, $b) use ($now) {
                    $dateTimeA = \DateTime::createFromFormat('Y-m-d H:i', $a['date'] . ' ' . ($a['time'] ?: '00:00'));
                    $dateTimeB = \DateTime::createFromFormat('Y-m-d H:i', $b['date'] . ' ' . ($b['time'] ?: '00:00'));
                    
                    if (!$dateTimeA || !$dateTimeB) return 0;
                    
                    // Hitung selisih absolut dari waktu sekarang (dalam detik)
                    $diffA = abs($dateTimeA->getTimestamp() - $now->timestamp);
                    $diffB = abs($dateTimeB->getTimestamp() - $now->timestamp);
                    
                    return $diffA <=> $diffB; // Yang paling dekat duluan
                });
                break;
                
            case 'date_desc':
                // Tanggal Terjauh: Sort dari tanggal terlama ke terbaru (descending)
                $aktivitasBulanIni = $aktivitasBulanIni->sortByDesc(function ($item) {
                    return $item['date'] . ' ' . ($item['time'] ?? '00:00');
                });
                break;
                
            case 'title_asc':
                // Judul A-Z
                $aktivitasBulanIni = $aktivitasBulanIni->sortBy('title', SORT_NATURAL | SORT_FLAG_CASE);
                break;
                
            case 'title_desc':
                // Judul Z-A
                $aktivitasBulanIni = $aktivitasBulanIni->sortByDesc('title', SORT_NATURAL | SORT_FLAG_CASE);
                break;
                
            default:
                // Default: Tanggal Terdekat
                $aktivitasBulanIni = $aktivitasBulanIni->sort(function ($a, $b) use ($now) {
                    $dateTimeA = \DateTime::createFromFormat('Y-m-d H:i', $a['date'] . ' ' . ($a['time'] ?: '00:00'));
                    $dateTimeB = \DateTime::createFromFormat('Y-m-d H:i', $b['date'] . ' ' . ($b['time'] ?: '00:00'));
                    
                    if (!$dateTimeA || !$dateTimeB) return 0;
                    
                    $diffA = abs($dateTimeA->getTimestamp() - $now->timestamp);
                    $diffB = abs($dateTimeB->getTimestamp() - $now->timestamp);
                    
                    return $diffA <=> $diffB;
                });
                break;
        }

        $aktivitasBulanIni = $aktivitasBulanIni->values()->toArray();

        // Kirim semua data ke view untuk di-handle oleh JavaScript
        return view('pages.kalendessr', [
            'daftarAktivitasJson' => json_encode(array_values($all_aktivitas)),
            'aktivitasBulanIni' => $aktivitasBulanIni,
            'bulan_filter' => $bulan_filter,
            'tahun_filter' => $tahun_filter,
        ]);
    }

    /**
     * Menyimpan acara baru atau memperbarui yang sudah ada.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id' => 'nullable|integer',
            'title' => 'required|string|max:255',
            'desk' => 'nullable|string',
            'tanggal' => 'required|date',
            'waktu' => 'nullable|date_format:H:i',
            'reminder_enabled' => 'nullable',
            'reminder_template' => 'nullable|string',
            'custom_reminder_time' => 'nullable|date_format:Y-m-d\TH:i',
        ]);

        $aktivitas = $this->getAktivitas();
        $isEdit = $request->filled('id');

        if ($isEdit) {
            // Logika Update
            $id = (int)$validated['id'];
            $index = collect($aktivitas)->search(fn($item) => $item['id'] == $id);

            if ($index !== false) {
                $aktivitas[$index]['title'] = $validated['title'];
                $aktivitas[$index]['desk'] = $validated['desk'] ?? '';
                $aktivitas[$index]['date'] = $validated['tanggal'];
                $aktivitas[$index]['time'] = $validated['waktu'] ?? '';
                
                // Update reminder logic
                $aktivitas[$index]['reminder'] = $request->input('reminder_enabled') ? ($validated['reminder_template'] ?? 'none') : 'none';
                $aktivitas[$index]['customTime'] = ($request->input('reminder_enabled') && ($validated['reminder_template'] ?? '') === 'custom') ? $validated['custom_reminder_time'] : null;
                
            }
        } else {
            // Logika Create
            $newId = (collect($aktivitas)->max('id') ?? 0) + 1;
            $aktivitas[] = [
                'id' => $newId,
                'title' => $validated['title'],
                'desk' => $validated['desk'],
                'date' => $validated['tanggal'],
                'time' => $validated['waktu'],
                'reminder' => $request->input('reminder_enabled') ? $validated['reminder_template'] : 'none',
                'customTime' => $request->input('reminder_enabled') && $validated['reminder_template'] === 'custom' ? $validated['custom_reminder_time'] : null,
                'status' => 'pending',
            ];
            Session::flash('status_message', 'Acara baru berhasil ditambahkan!');
        }

        Session::put('mock_aktivitas', $aktivitas);

        return redirect()->route('kalender.index');
    }

    /**
     * Menghapus acara.
     */
    public function delete(Request $request)
    {
        $validated = $request->validate(['id' => 'required|integer']);
        $idToDelete = (int)$validated['id'];

        $aktivitas = $this->getAktivitas();

        // Filter array untuk menghapus item
        $filteredAktivitas = array_filter($aktivitas, fn($item) => $item['id'] !== $idToDelete);

        Session::put('mock_aktivitas', array_values($filteredAktivitas));

        return redirect()->route('kalender.index');
    }
}
