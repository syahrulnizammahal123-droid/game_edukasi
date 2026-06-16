<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoalKilat extends Model
{
    use HasFactory;

    // Menentukan nama tabel secara eksplisit di database
    protected $table = 'soal_kilats';

    /**
     * Properti Fillable untuk memberikan izin pengisian data massal.
     * Kode inilah yang akan langsung menyembuhkan error MassAssignmentException kamu.
     */
    protected $fillable = [
        'level',
        'pernyataan',
        'jawaban_benar',
        'penjelasan',
    ];
}