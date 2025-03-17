<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teaching extends Model
{
    use HasFactory;

    protected $table = 'teachings'; // Nama tabel di database

    protected $fillable = [
        'class_id',
        'subject_id',
        'user_id'
    ];

    /**
     * Relasi ke tabel `student_classes` (Kelas).
     */
    public function class()
    {
        return $this->belongsTo(StudentClass::class, 'class_id');
    }

    /**
     * Relasi ke tabel `subjects` (Mata Pelajaran).
     */
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    /**
     * Relasi ke tabel `users` (Guru).
     */
    public function teacher()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
