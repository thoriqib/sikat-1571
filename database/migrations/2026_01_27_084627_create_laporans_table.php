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
            $table->string('judul');
            $table->foreignId('iku_id')
                ->constrained('iku')
                ->cascadeOnDelete();
            $table->foreignId('tahapan_id')
                ->constrained('tahapan')
                ->cascadeOnDelete();
                $table->enum('triwulan', ['I', 'II', 'III', 'IV']);
            $table->year('tahun');
            $table->text('isi')->nullable();
            $table->string('file_path')->nullable();
            $table->string('file_original_name')->nullable();
            $table->integer('file_size')->nullable();
            $table->string('file_mime')->nullable();
            $table->timestamps();
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
