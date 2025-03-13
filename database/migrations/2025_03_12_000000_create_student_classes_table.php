<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('student_classes', function (Blueprint $table) {
            $table->id();
            $table->string('nama'); // Nama kelas, misalnya "6A"
            $table->unsignedBigInteger('wali_kelas_id')->nullable(); // Relasi ke users (wali kelas)
            $table->timestamps();

            // Foreign key ke tabel users
            $table->foreign('wali_kelas_id')
                ->references('id')
                ->on('users')
                ->onDelete('set null')
                ->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_classes');
    }
};
