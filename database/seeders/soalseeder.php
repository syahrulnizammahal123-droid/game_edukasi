<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Soal;

class SoalSeeder extends Seeder
{

    public function run(): void
    {

        /*
        |--------------------------------------------------------------------------
        | LEVEL 1
        |--------------------------------------------------------------------------
        */

        for ($i = 1; $i <= 10; $i++) {

            Soal::create([

                'pertanyaan' =>
                    'Level 1 - Berapa hasil dari '.$i.' + '.$i.' ?',

                'A' => $i,

                'B' => $i * 2,

                'C' => $i * 3,

                'D' => $i * 4,

                'jawaban' => 'B',

                'penjelasan' =>
                    'Karena '.$i.' + '.$i.' = '.($i * 2),

                'level' => 1

            ]);

        }

        /*
        |--------------------------------------------------------------------------
        | LEVEL 2
        |--------------------------------------------------------------------------
        */

        for ($i = 1; $i <= 10; $i++) {

            Soal::create([

                'pertanyaan' =>
                    'Level 2 - Berapa hasil dari '.($i * 2).' x 2 ?',

                'A' => $i * 2,

                'B' => $i * 3,

                'C' => $i * 4,

                'D' => $i * 5,

                'jawaban' => 'C',

                'penjelasan' =>
                    'Karena '.($i * 2).' x 2 = '.($i * 4),

                'level' => 2

            ]);

        }

        /*
        |--------------------------------------------------------------------------
        | LEVEL 3
        |--------------------------------------------------------------------------
        */

        for ($i = 1; $i <= 10; $i++) {

            Soal::create([

                'pertanyaan' =>
                    'Level 3 - Berapa hasil dari '.($i * 5).' - '.$i.' ?',

                'A' => $i * 2,

                'B' => $i * 3,

                'C' => $i * 4,

                'D' => $i * 5,

                'jawaban' => 'C',

                'penjelasan' =>
                    'Karena '.($i * 5).' - '.$i.' = '.($i * 4),

                'level' => 3

            ]);

        }

    }

}