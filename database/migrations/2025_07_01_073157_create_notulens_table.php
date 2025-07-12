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
        Schema::create('notulens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('agenda_id');
            $table->text('notulen')->nullable();
            $table->text('pembicara');
            $table->text('poin_pembahasan');
            $table->text('kesimpulan')->nullable();
            $table->timestamps();

            $table->foreign('agenda_id')->references('id')->on('agendas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notulens');
    }
};
