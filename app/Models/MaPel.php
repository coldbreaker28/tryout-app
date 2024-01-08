<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaPel extends Model
{
    use HasFactory;
    protected $table = 'ma_pels';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama',
    ];
    public function soalUjian()
    {
        # code...
        return $this->hasOne(SoalUjian::class, 'ma_pel_id');
    }
}