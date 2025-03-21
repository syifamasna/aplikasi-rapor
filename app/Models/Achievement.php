<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    use HasFactory;

    protected $table = 'achievements';

    protected $fillable = [
        'student_id',
        'jenis_prestasi',
        'keterangan',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function scopeAkademik($query)
    {
        return $query->where('jenis_prestasi', 'Akademik');
    }

    public function scopeNonAkademik($query)
    {
        return $query->where('jenis_prestasi', 'Non-Akademik');
    }
}
