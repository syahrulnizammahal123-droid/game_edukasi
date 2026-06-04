<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('progress', function (Blueprint $table) {

            $table->integer('total_play')->default(0);
            $table->integer('correct_answer')->default(0);
            $table->integer('wrong_answer')->default(0);

        });
    }

    public function down(): void
    {
        Schema::table('progress', function (Blueprint $table) {

            $table->dropColumn([
                'total_play',
                'correct_answer',
                'wrong_answer'
            ]);

        });
    }
};