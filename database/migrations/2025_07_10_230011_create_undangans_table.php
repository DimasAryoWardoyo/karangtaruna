<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('undangans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_almarhum');
            $table->string('umur')->nullable();
            $table->date('hari_wafat');
            $table->time('jam_wafat');
            $table->string('lokasi_wafat');

            $table->date('hari_pemakaman');
            $table->time('jam_pemakaman');
            $table->string('tempat_pemakaman');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('undangans');
    }
};
