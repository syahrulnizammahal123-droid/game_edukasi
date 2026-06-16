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
        Schema::create('soal_kilats', function (Blueprint $table) {
            $table->id();
            $table->integer('level');             // Untuk tingkatan level kuis (1, 2, atau 3)
            $table->text('pernyataan');          // Teks pernyataan berpikir kritis yang akan dinilai siswa
            $table->boolean('jawaban_benar');    // Kunci jawaban: true (Benar) atau false (Salah)
            $table->text('penjelasan')->nullable(); // Penjelasan / pembahasan ilmiah setelah siswa menjawab
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('soal_kilats');
    }
};