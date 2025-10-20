<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CatatanController extends Controller
{
    // Pastikan user login dulu
    private function checkAuth()
    {
        if (!session()->has('user')) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
        }
    }

    // Menampilkan halaman catatan
    public function index()
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $notes = session('notes', []);
        return view('pages.catatan', compact('notes'));
    }

    // Menyimpan catatan baru
    public function store(Request $request)
    {
        $notes = session('notes', []);
        $newNote = [
            'id' => uniqid(),
            'judul' => $request->judul,
            'isi' => $request->isi,
        ];
        $notes[] = $newNote;

        session(['notes' => $notes]);
        return redirect('/catatan')->with('success', 'Catatan berhasil ditambahkan!');
    }

    // Update catatan
    public function update(Request $request, $id)
    {
        $notes = session('notes', []);
        foreach ($notes as &$note) {
            if ($note['id'] === $id) {
                $note['judul'] = $request->judul;
                $note['isi'] = $request->isi;
                break;
            }
        }
        session(['notes' => $notes]);
        return redirect('/catatan')->with('success', 'Catatan berhasil diperbarui!');
    }

    // Hapus catatan
    public function destroy($id)
    {
        $notes = session('notes', []);
        $notes = array_filter($notes, fn($n) => $n['id'] !== $id);
        session(['notes' => array_values($notes)]);
        return redirect('/catatan')->with('info', 'Catatan dihapus.');
    }
}
