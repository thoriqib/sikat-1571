<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('iku', function (Blueprint $table) {
            $table->decimal('realisasi', 8, 2)->nullable()->after('target');
        });
    }

    public function down(): void
    {
        Schema::table('iku', function (Blueprint $table) {
            $table->dropColumn('realisasi');
        });
    }
};
