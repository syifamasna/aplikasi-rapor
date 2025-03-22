<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $table = 'subjects'; // Nama tabel di database

    protected $fillable = [
       'nama',
       'singkatan',
       'kelompok_mapel',
       'capaian',
       'tujuan',
       'aplikasi'
    ];

    public function teachings()
    {
        return $this->belongsToMany(StudentClass::class, 'teachings', 'subject_id', 'class_id');
    }
}
