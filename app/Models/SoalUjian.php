<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoalUjian extends Model
{
    use HasFactory;
    protected $table = 'soal_ujians';
    protected $primaryKey = 'id';
    protected $fillable = [
        'ma_pel_id',
        'jenis_soal',
        'pertanyaan',
        'jawaban_benar',
        'pilihan_a',
        'pilihan_b',
        'pilihan_c',
        'pilihan_d',
    ];
    public function mataPelajaran()
    {
        # code...
        return $this->belongsTo(MaPel::class, 'ma_pel_id');
    }
    public function jawabanMahasiswa()
    {
        # code...
        return $this->hasOne(JawabanMahasiswa::class, 'soal_ujian_id');
    }
}
