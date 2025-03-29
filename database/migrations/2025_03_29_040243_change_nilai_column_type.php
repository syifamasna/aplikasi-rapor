<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('grades', function (Blueprint $table) {
            $table->tinyInteger('nilai')->unsigned()->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('grades', function (Blueprint $table) {
            $table->decimal('nilai', 5, 2)->nullable()->change(); // Kembalikan ke decimal jika rollback
        });
    }

};
