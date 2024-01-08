<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswas';
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'nama',
        'nim',
        'email',
        'password',
        'skor',
    ];
    public function user()
    {
        # code...
        return $this->belongsTo(User::class);
    }

    public function jawabanMahasiswa()
    {
        # code...
        return $this->hasMany(JawabanMahasiswa::class, 'mahasiswa_id');
    }
}
