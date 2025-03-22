<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id'); // ID siswa yang diberi catatan
            $table->unsignedBigInteger('school_year_id'); // Tahun ajaran
            $table->text('catatan'); // Isi catatan
            $table->timestamps();

            // Relasi ke tabel students
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');

            // Relasi ke tabel school_years
            $table->foreign('school_year_id')->references('id')->on('school_years')->onDelete('cascade');

            // Pastikan tidak ada duplikasi catatan untuk siswa & tahun ajaran yang sama
            $table->unique(['student_id', 'school_year_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
