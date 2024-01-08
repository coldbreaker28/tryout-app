<?php

namespace App\Http\Controllers\Components;

use App\Http\Controllers\Controller;
use App\Models\MaPel;
use App\Models\JawabanMahasiswa;
use App\Models\SoalUjian;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class SiswaController extends Controller
{
    #code.....

    public function indexHome()
    {
        # code...
        return view('mahasiswa.index-home');
    }

    public function profileMahasiswa()
    {
        # code...
        $userId = Auth::id();
        $profile = User::with('mahasiswa')->findOrFail($userId);
        return view('mahasiswa.index-profil', compact('profile'));
    }

    // Fungsi untuk menampilkan halaman ujian
    public function ujianMahasiswa()
    {
        $soal = SoalUjian::with('mataPelajaran')
            ->where('jenis_soal', 'pilihan ganda')
            ->get()->shuffle();

        // Loop melalui setiap soal dan acak urutan pilihan jawaban
        return view('mahasiswa.index-ujian', compact('soal'));
    }
    public function submitJawaban(Request $request)
    {
        // TODO : tambahkan value / data yang sudah dilakukan melalui form ujian / validate diatas.
        // waktu_mulai_ujian menggunakan now(). dan jawaban mahasiswa itu menggunakan valdate diatas, dan soal_ujian_id itu kita dapat mendapatkannya dari jawaban dari soal tersebut. 
        // dan kolom poin didapatkan jika memenuhi kondisi dibawah : 
        // jika soal/pertanyaan dijawab atau jika jawaban ada maka proses akan berlanjut dan status akan menjadi 'selesai'
        // TODO : tambahkan juga kondisi pengecualian, dimana jika status pada kolom status = belum_selesai, maka tidak akan dihitung dan poin secara otomatis akan menjadi 0 tanpa terkecuali.
        // kemudian dari sini mahasiswa akan mendapatkan poin yang sudah berhasil didapat dari menjawab pertanyaan-pertanyaan yang telah disediakan. 
        // cara menghitungnya adalah kita menggunakan persamaan dengan kolom 'jawaban_benar' pada tabel soalUjians (mengingat hal ini karena kedua tabel ini sudah berelasi). 
        // jika sama dengan value dari 'jawaban_benar' maka akan mendapatkan poin 10, jika tidak sama dengan value dari 'jawaban_benar' maka akan mendapat poin 0.
        // kemudian simpan ke basis data.

        // Validasi formulir
        $request->validate([
            // Sesuaikan aturan validasi sesuai kebutuhan
            'jawaban_mahasiswa.*' => [
                'required',
                    Rule::in(['pilihan_a', 'pilihan_b', 'pilihan_c', 'pilihan_d']),      
            ], 
        ]);
        $mahasiswa = Auth::user()->mahasiswa;
        $waktuMulaiUjian = now();
        // deklarasikan jumlah jawaban dari mahasiswa
        $totalBenar = 0;
        $totalSalah = 0;
        foreach ($request->jawaban_mahasiswa as $soal_ujian_id => $index) {
            // Temukan soal ujian berdasarkan ID
            $soalUjian = SoalUjian::findOrFail($soal_ujian_id);
            // Ambil data jawaban dari array pilihan
            $label = substr($index, -1);
            $jawaban = $soalUjian['pilihan_' . strtolower($label)];
            // Hitung poin berdasarkan jawaban
            $poin = ($jawaban !== null && $jawaban === $soalUjian->jawaban_benar) ? 10 : 0;
            // Tentukan status berdasarkan jawaban 
            $status = ($jawaban !== null) ? 'selesai' : 'belum selesai';
            // simpan jawaban mahasiswa ke basis data
            $jawabanMahasiswa = new JawabanMahasiswa([
                'mahasiswa_id' => $mahasiswa->id,
                'soal_ujian_id' => $soalUjian->id,
                'waktu_mulai_ujian' => $waktuMulaiUjian,
                'status' => $status,
                'jawaban_mahasiswa' => $jawaban,
                'poin' => $poin,
            ]);

            // TODO : tambahkan LOGIKA bisnis dengan menghitung skor dari poin-poin yang ada pada kolom poin di tabel jawaban_mahasiswa dengan cara menjumlahkan poin-poin tersebut. 
            // dan hasilnya akan menjadi value dari kolom skor dari tabel mahasiswa.
            // kemudian simpan ke basis data.

            $jawabanMahasiswa->save();
        
            // Akumulasi jumlah benar dan salah dari jawaban mahasiswa
            if ($poin > 0) {
                $totalBenar++;
            } else {
                $totalSalah++;
            }
        }

        // Hitung skor berdasarkan poin jawaban mahasiswa
        // $skor = $mahasiswa->jawabanMahasiswa()->sum('poin');
        // Misalkan per jawaban benar dihitung 10
        $skor = $totalBenar * 10;
        // Update skor Mahasiswa
        $mahasiswa->update(['skor' => $skor]);

        return redirect()->route('mahasiswa.home')->with('success', 'Jawaban berhasil disimpan!');
    }
    public function nilaiMahasiswa()
    {
        $mahasiswa = Auth::user()->mahasiswa;
    
        // Ambil data jawaban mahasiswa
        $jawaban = JawabanMahasiswa::with('soalUjian')->where('mahasiswa_id', $mahasiswa->id)->get();
    
        // Hitung total jawaban benar dan jawaban salah
        $jawabanBenar = $jawaban->where('poin', '>', 0)->count();
        $jawabanSalah = $jawaban->where('poin', 0)->count();
    
        // Hitung total skor
        $totalSkor = $mahasiswa->jawabanMahasiswa()->sum('poin');
    
        // Kalkulasi data untuk grafik lingkaran
        $dataGrafik = [
            'labels' => ['Jawaban Benar', 'Jawaban Salah'],
            'data' => [$jawabanBenar, $jawabanSalah],
            'backgroundColor' => ['#28a745', '#dc3545'],
        ];
    
        return view('mahasiswa.index-nilai', compact('totalSkor', 'dataGrafik', 'jawaban'));
    }
}