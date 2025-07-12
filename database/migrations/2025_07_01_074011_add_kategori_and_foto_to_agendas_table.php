<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('agendas', function (Blueprint $table) {
            $table->enum('kategori', ['kegiatan', 'rapat'])->after('nama_agenda');
            $table->string('foto')->nullable()->after('kategori');
        });
    }

    public function down()
    {
        Schema::table('agendas', function (Blueprint $table) {
            $table->dropColumn(['kategori', 'foto']);
        });
    }
};
