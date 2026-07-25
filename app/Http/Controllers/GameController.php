<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
     * Menampilkan halaman Peringkat Global / Leaderboard
     */
    public function leaderboard()
    {
        try {
            $users = User::orderBy('score', 'desc')->get();
        } catch (\Exception $e) {
            $users = collect([]);
        }

        if ($users->isEmpty()) {
            $users = collect([
                (object) ['name' => 'Nizam', 'total_xp' => 1250, 'score' => 1250],
                (object) ['name' => 'Siswa B', 'total_xp' => 980,  'score' => 980],
                (object) ['name' => 'Siswa C', 'total_xp' => 850,  'score' => 850],
            ]);
        }

        return view('leaderboard', compact('users'));
    }

    /**
     * Menampilkan daftar level permainan
     */
    public function level()
    {
        // Set default player level ke 1 (bisa disesuaikan nanti jika ada sistem unlock)
        $playerLevel = auth()->user()->level ?? 1;

        return view('game.level', compact('playerLevel'));
    }

    /**
     * Memulai permainan sesuai level
     */
    public function start($level)
    {
        return view('game.play', compact('level'));
    }

    /**
     * Memproses jawaban game
     */
    public function jawab(Request $request)
    {
        return redirect()->route('game.next');
    }

    /**
     * Lanjut ke soal berikutnya
     */
    public function next()
    {
        return redirect()->route('game.hasil');
    }

    /**
     * Menampilkan hasil permainan
     */
    public function hasil()
    {
        return view('game.hasil');
    }

    /**
     * Menampilkan riwayat permainan
     */
    public function riwayat()
    {
        return view('game.riwayat');
    }

    /**
     * Kelola Bank Soal (Index)
     */
    public function soal()
    {
        try {
            $soals = \App\Models\Soal::all();
        } catch (\Exception $e) {
            $soals = collect([]);
        }

        // 15 Soal Informatika SMK untuk tampilan awal
        if ($soals->isEmpty()) {
            $soals = collect([
                (object)['pertanyaan' => 'Komponen fisik komputer yang dapat disentuh dan dilihat secara langsung disebut...', 'jawaban_benar' => 'B'],
                (object)['pertanyaan' => 'Otak dari komputer yang bertugas memproses seluruh instruksi dan data adalah...', 'jawaban_benar' => 'C'],
                (object)['pertanyaan' => 'Jenis memori komputer yang bersifat sementara dan akan hilang datanya saat dimatikan adalah...', 'jawaban_benar' => 'D'],
                (object)['pertanyaan' => 'Bahasa markup standar yang digunakan untuk membuat dan menyusun struktur halaman web adalah...', 'jawaban_benar' => 'A'],
                (object)['pertanyaan' => 'Perangkat jaringan yang berfungsi untuk menghubungkan beberapa jaringan yang berbeda adalah...', 'jawaban_benar' => 'C'],
                (object)['pertanyaan' => 'Kombinasi tombol keyboard yang digunakan untuk menyalin (copy) teks atau file adalah...', 'jawaban_benar' => 'B'],
                (object)['pertanyaan' => 'Contoh alamat IP versi 4 (IPv4) yang benar di bawah ini adalah...', 'jawaban_benar' => 'A'],
                (object)['pertanyaan' => 'Ekstensi file gambar yang mendukung latar belakang transparan adalah...', 'jawaban_benar' => 'B'],
                (object)['pertanyaan' => 'Program atau perangkat lunak yang dirancang untuk merusak atau mencuri data komputer disebut...', 'jawaban_benar' => 'C'],
                (object)['pertanyaan' => 'Perintah SQL yang digunakan untuk mengambil atau menampilkan data dari tabel adalah...', 'jawaban_benar' => 'D'],
                (object)['pertanyaan' => 'Jenis konektor yang dipasang di ujung kabel LAN (UTP) adalah konektor...', 'jawaban_benar' => 'B'],
                (object)['pertanyaan' => 'Sistem operasi open-source yang banyak digunakan untuk server adalah...', 'jawaban_benar' => 'C'],
                (object)['pertanyaan' => 'Istilah untuk kesalahan atau cacat pada kodingan program komputer disebut...', 'jawaban_benar' => 'A'],
                (object)['pertanyaan' => 'Layanan penyimpanan file secara online berbasis internet disebut...', 'jawaban_benar' => 'B'],
                (object)['pertanyaan' => 'Aplikasi web browser yang digunakan untuk menjelajahi internet adalah...', 'jawaban_benar' => 'A'],
            ]);
        }

        return view('soal.index', compact('soals'));
    }

    public function createSoal()
    {
        return view('soal.create');
    }

    public function storeSoal(Request $request)
    {
        return redirect()->route('soal.index');
    }

    public function editSoal($id)
    {
        return view('soal.edit', compact('id'));
    }

    public function updateSoal(Request $request, $id)
    {
        return redirect()->route('soal.index');
    }

    public function deleteSoal($id)
    {
        return redirect()->route('soal.index');
    }
}