<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GraduationDecision extends Model
{
    use HasFactory;

    protected $table = 'graduation_decisions';

    protected $fillable = [
        'student_id',
        'school_year_id',
        'status',
    ];

    // Relasi ke Siswa
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    // Relasi ke Tahun Ajaran
    public function schoolYear()
    {
        return $this->belongsTo(SchoolYear::class);
    }
}
