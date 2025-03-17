<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentClass extends Model
{
    use HasFactory;

    protected $table = 'student_classes'; // Nama tabel di database

    protected $fillable = [
       'nama',
       'wali_kelas_id',
    ];
    
    public function students()
    {
        return $this->hasMany(Student::class, 'class_id');
    }    

    public function waliKelas()
    {
        return $this->belongsTo(User::class, 'wali_kelas_id');
    }

}
