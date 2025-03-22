<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $table = 'grades';

    protected $fillable = [
        'student_id',
        'school_year_id',
        'subject_id',
        'nilai',
        'capaian',
        'target',
        'aplikasi_program',
    ];

    protected $casts = [
        'capaian' => 'array',
        'target' => 'array',
        'aplikasi_program' => 'array',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function schoolYear()
    {
        return $this->belongsTo(SchoolYear::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
