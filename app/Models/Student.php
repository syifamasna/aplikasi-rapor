<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = 'students';

    protected $fillable = [
        'nama',
        'class_id',
        'jk',
        'nis',
        'nisn'
    ];

    public function class()
    {
        return $this->belongsTo(StudentClass::class, 'class_id');
    }

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }

    public function graduationDecisions()
    {
        return $this->hasMany(\App\Models\GraduationDecision::class);
    }
}
