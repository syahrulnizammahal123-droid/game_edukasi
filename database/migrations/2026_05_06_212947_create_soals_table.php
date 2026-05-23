<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run migrations
     */
    public function up(): void
    {
        Schema::create('soals', function (Blueprint $table) {

            $table->id();

            $table->text('pertanyaan');

            $table->string('A');

            $table->string('B');

            $table->string('C');

            $table->string('D');

            $table->string('jawaban');

            $table->text('penjelasan');

            $table->integer('level');

            $table->timestamps();

        });
    }

    /**
     * Reverse migrations
     */
    public function down(): void
    {
        Schema::dropIfExists('soals');
    }
};