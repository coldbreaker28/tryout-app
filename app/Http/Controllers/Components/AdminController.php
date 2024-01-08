<?php

namespace App\Http\Controllers\Components;

use App\Http\Controllers\Controller;
use App\Models\JadwalUjian;
use App\Models\JawabanMahasiswa;
use App\Models\Mahasiswa;
use App\Models\MaPel;
use App\Models\SoalUjian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AdminController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        $mahasiswa = Mahasiswa::with('user')->get()->all();
        $totalSoal = SoalUjian::count();
        $mataPelajaran = [
            'Bahasa Indonesia',
            'Matematika',
            'Bahasa Inggris',
        ];
        $soalPerMaPel = [];
        $jenisSoalPerMapel = [];
        foreach ($mataPelajaran as $mapel) {
            $count = MaPel::where('nama', $mapel)->count();
            $soalPerMaPel[$mapel] = $count;
        }
        foreach ($mataPelajaran as $mapel) {
            $countPilihanGanda = SoalUjian::where('jenis_soal', 'pilihan ganda')->whereHas('mataPelajaran', function ($query) use ($mapel) {
                $query->where('nama', $mapel);
            })->count();
            $countEsai = SoalUjian::where('jenis_soal', 'esai')->whereHas('mataPelajaran', function ($query) use ($mapel) {
                $query->where('nama', $mapel);
            })->count();

            $jenisSoalPerMapel[$mapel] = [
                'pilihan ganda' => $countPilihanGanda,
                'esai' => $countEsai,
            ];
        }

        return view('admin.home', [
            'totalSoal' => $totalSoal,
            'soalPerMapel' => $soalPerMaPel,
            'jenisSoalPerMapel' => $jenisSoalPerMapel,
        ], compact('mahasiswa'));
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function ujian(Request $request): View
    {
        $soalUjians = SoalUjian::with('mataPelajaran')->paginate(5);
        return view('admin.tasks.ujian',
            [
                'soalUjians' => $soalUjians,
            ] ,
        compact('soalUjians'));
    }
    
    // Make API data Soal Ujian
    public function getSoal(){
        # code...
        $soalUjians = SoalUjian::with('mataPelajaran')->get();
        return response()->json([
            'soalUjians' => $soalUjians,
        ]);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function buat_soal()
    {
        return view('admin.tasks.buat_soal');
    }
    public function store_soal(Request $request)
    {
        # code...
        $request->validate([
            'jenis_soal' => 'required|string|in:esai,pilihan ganda',
            'nama_mata_pelajaran' => 'required|string',
            'pertanyaan' => 'required|string',
            'jawaban_benar' => [
                'required',
                Rule::requiredIf(function () use ($request) {
                    return $request->jenis_soal == 'pilihan ganda';
                }),
            ],
            'pilihan_a' => [
                Rule::requiredIf(function () use ($request) {
                    return $request->jenis_soal == 'pilihan ganda';
                }),
            ],
            'pilihan_b' => [
                Rule::requiredIf(function () use ($request) {
                    // Hanya membutuhkan pilihan b jika jenis soal adalah 'pilihan ganda'
                    return $request->jenis_soal == 'pilihan ganda';
                }),
            ],
            'pilihan_c' => [
                Rule::requiredIf(function () use ($request) {
                    // Hanya membutuhkan pilihan c jika jenis soal adalah 'pilihan ganda'
                    return $request->jenis_soal == 'pilihan ganda';
                }),
            ],
            'pilihan_d' => [
                Rule::requiredIf(function () use ($request) {
                    // Hanya membutuhkan pilihan d jika jenis soal adalah 'pilihan ganda'
                    return $request->jenis_soal == 'pilihan ganda';
                }),
            ],
        ]);
        // Buat mata pelajaran baru atau dapatkan yang sudah ada
        $mapel = MaPel::Create([
            'nama' => $request->nama_mata_pelajaran
        ]);

        // Lakukan operasi penyimpanan jika validasi berhasil
        SoalUjian::create([
            'ma_pel_id' => $mapel->id,
            'jenis_soal' => $request->jenis_soal,
            'pertanyaan' => $request->pertanyaan,
            'jawaban_benar' => $request->jawaban_benar,
            'pilihan_a' => $request->pilihan_a ?? null,
            'pilihan_b' => $request->pilihan_b ?? null,
            'pilihan_c' => $request->pilihan_c ?? null,
            'pilihan_d' => $request->pilihan_d ?? null,
        ]);

        return redirect()->route('admin.ujian')->with('success', 'Soal Ujian berhasil disimpan');
    }
    public function showSoal($id)
    {
        # code...
        $soalUjians = SoalUjian::with('mataPelajaran')->findOrFail($id);
        return view('admin.tasks.detail-soal', compact('soalUjians'));
    }
    public function editSoal($id)
    {
        # code...
        $soalUjians = SoalUjian::with('mataPelajaran')->findOrFail($id);
        return view('admin.tasks.edit-soal', compact('soalUjians'));
    }
    public function updateSoal(Request $request, $id)
    {
        # code...
        $request->validate([
            'jenis_soal' => 'required|string|in:esai,pilihan ganda',
            'nama_mata_pelajaran' => 'required|string',
            'pertanyaan' => 'required|string',
            'jawaban_benar' => [
                'required',
                Rule::requiredIf(function () use ($request) {
                    return $request->jenis_soal == 'pilihan ganda';
                }),
            ],
            'pilihan_a' => [
                Rule::requiredIf(function () use ($request) {
                    return $request->jenis_soal == 'pilihan ganda';
                }),
            ],
            'pilihan_b' => [
                Rule::requiredIf(function () use ($request) {
                    // Hanya membutuhkan pilihan b jika jenis soal adalah 'pilihan ganda'
                    return $request->jenis_soal == 'pilihan ganda';
                }),
            ],
            'pilihan_c' => [
                Rule::requiredIf(function () use ($request) {
                    // Hanya membutuhkan pilihan c jika jenis soal adalah 'pilihan ganda'
                    return $request->jenis_soal == 'pilihan ganda';
                }),
            ],
            'pilihan_d' => [
                Rule::requiredIf(function () use ($request) {
                    // Hanya membutuhkan pilihan d jika jenis soal adalah 'pilihan ganda'
                    return $request->jenis_soal == 'pilihan ganda';
                }),
            ],
        ]);

        $soalUjians = SoalUjian::with('mataPelajaran')->findOrFail($id);
        $mapel = $soalUjians->mataPelajaran;
        $mapel->nama = $request->input('nama_mata_pelajaran');
        $mapel->save();

        $soalUjians->update([
            'jenis_soal' => $request->input('jenis_soal'),
            'pertanyaan' => $request->input('pertanyaan'),
            'jawaban_benar' => $request->input('jawaban_benar'),
            'pilihan_a' => $request->input('pilihan_a'),
            'pilihan_b' => $request->input('pilihan_b'),
            'pilihan_c' => $request->input('pilihan_c'),
            'pilihan_d' => $request->input('pilihan_d'),
        ]);

        return redirect()->intended('admin/kelola-ujian')->withSuccess('Data has been UPDATE!!');
        
    }
    public function hapusSoal($id)
    {
        # code...
        $soalUjians = SoalUjian::with('mataPelajaran')->findOrFail($id);
        $soalUjians->delete();
        if ($soalUjians->mataPelajaran) {
            $soalUjians->mataPelajaran->delete();
        }
        return redirect()->intended('admin/kelola-ujian')->withSuccess('Data has been DELETE!!');
    }
    public function indexPeserta()
    {
        # code...
        $data = Mahasiswa::with('user')->get()->all();
        return view('admin.users.peserta', compact('data'));
    }
    public function showPeserta($id)
    {
        # code...
        $data = Mahasiswa::with('user')->findOrFail($id);
        $jawaban = JawabanMahasiswa::with('mahasiswa')->get();
        return view('admin.users.detail-peserta', compact('data', 'jawaban'));
    }
    public function editPeserta($id)
    {
        # code...
        $data = Mahasiswa::with('user')->findOrFail($id);
        return view('admin.users.edit-peserta', compact('data'));
    }
    public function updatePeserta(Request $request, $id)
    {
        # code...
        $data = Mahasiswa::with('user')->findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'nim' => 'required|string|unique:mahasiswas,nim',
        ]);
        $user = $data->user;
        $user->name = $request->input('name');
        $user->save();

        $data->update([
            'nama' => $request->input('name'),
            'nim' => $request->input('nim'),
        ]);

        return redirect()->intended('admin/kelola-peserta-ujian')->withSuccess('Data has been UPDATE!!');
    }
    public function hapusPeserta($id)
    {
        # code...
        $data = Mahasiswa::with('user')->findOrFail($id);
        $data->delete();
        if ($data->user) {
            $data->user->delete();
        }
        return redirect()->route('admin.peserta')->withSuccess('Data has been DELETE!!');
    }
    public function indexLaporan()
    {
        # code...
        $data = Mahasiswa::with('user')->get()->all();
        return view('admin.laporan', compact('data'));
    }
}