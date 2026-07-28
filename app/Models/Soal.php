<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    use HasFactory;

    /**
     * Nama tabel di database
     */
    protected $table = 'soals';

    /**
     * Kolom-kolom yang dapat diisi secara massal (Mass Assignment)
     */
    protected $fillable = [
        'level',
        'pertanyaan',
        'A',
        'B',
        'C',
        'D',
        'jawaban',
        'penjelasan',
    ];
}