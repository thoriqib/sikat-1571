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
        Schema::create('laporan', function (Blueprint $table) {
            $table->id();

            $table->foreignId('kegiatan_id')
                ->constrained('kegiatan')
                ->cascadeOnDelete();

            $table->foreignId('tahapan_id')
                ->constrained('tahapan')
                ->cascadeOnDelete();

            $table->enum('triwulan', ['I', 'II', 'III', 'IV']);
            $table->year('tahun');

            $table->string('judul');
            $table->text('isi')->nullable();
            $table->string('link_laporan');

            $table->foreignId('uploaded_by')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->timestamps();

            $table->unique([
                'kegiatan_id',
                'tahapan_id',
                'triwulan',
                'tahun'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan');
    }
};
