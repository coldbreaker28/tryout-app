<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JawabanMahasiswa extends Model
{
    use HasFactory;
    protected $table = 'jawaban_mahasiswas';
    protected $primaryKey = 'id';
    protected $fillable = [
        'mahasiswa_id',
        'soal_ujian_id',
        'jawaban_mahasiswa',
        'waktu_mulai_ujian',
        'status',
        'poin',
    ];
    public function mahasiswa()
    {
        # code...
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }
    public function soalUjian()
    {
        # code...
        return $this->belongsTo(SoalUjian::class, 'soal_ujian_id');
    }
    public function getJawabanMahasiswaAttribute($value)
    {
        # code...
        return $this->attributes['jawaban_mahasiswa'];
    }
}