<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'role')) {
                $table->string('role', 20)->default('siswa')->after('password');
            }
        });

        Schema::table('progress', function (Blueprint $table) {
            if (!Schema::hasColumn('progress', 'total_xp')) {
                $table->integer('total_xp')->default(0)->after('high_score');
            }
        });

        Schema::table('game_histories', function (Blueprint $table) {
            if (!Schema::hasColumn('game_histories', 'correct_answer')) {
                $table->integer('correct_answer')->default(0)->after('grade');
            }

            if (!Schema::hasColumn('game_histories', 'wrong_answer')) {
                $table->integer('wrong_answer')->default(0)->after('correct_answer');
            }

            if (!Schema::hasColumn('game_histories', 'total_question')) {
                $table->integer('total_question')->default(0)->after('wrong_answer');
            }

            if (!Schema::hasColumn('game_histories', 'accuracy')) {
                $table->integer('accuracy')->default(0)->after('total_question');
            }

            if (!Schema::hasColumn('game_histories', 'xp_earned')) {
                $table->integer('xp_earned')->default(0)->after('accuracy');
            }
        });

        DB::table('users')
            ->whereNull('role')
            ->orWhere('role', '')
            ->update(['role' => 'siswa']);
    }

    public function down(): void
    {
        Schema::table('game_histories', function (Blueprint $table) {
            $columns = [
                'correct_answer',
                'wrong_answer',
                'total_question',
                'accuracy',
                'xp_earned',
            ];

            foreach ($columns as $column) {
                if (Schema::hasColumn('game_histories', $column)) {
                    $table->dropColumn($column);
                }
            }
        });

        Schema::table('progress', function (Blueprint $table) {
            if (Schema::hasColumn('progress', 'total_xp')) {
                $table->dropColumn('total_xp');
            }
        });

        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'role')) {
                $table->dropColumn('role');
            }
        });
    }
};
