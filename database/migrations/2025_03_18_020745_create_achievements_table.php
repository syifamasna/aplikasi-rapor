<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('achievements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id'); // Foreign key ke tabel students
            $table->enum('jenis_prestasi', ['Akademik', 'Non-Akademik']);
            $table->string('keterangan');
            $table->timestamps();

            // Relasi ke tabel students
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('achievements');
    }
};
