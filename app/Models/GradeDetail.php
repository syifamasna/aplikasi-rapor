<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradeDetail extends Model
{
    use HasFactory;

    protected $table = 'grade_details';
    
    protected $fillable = [
        'grade_id',
        'target',
        'capaian',
        'aplikasi_program',
    ];

    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }
}