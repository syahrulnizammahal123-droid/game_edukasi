<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('progress', function (Blueprint $table) {

            $table->integer('health')->default(3);

        });
    }

    public function down(): void
    {
        Schema::table('progress', function (Blueprint $table) {

            $table->dropColumn('health');

        });
    }
};
