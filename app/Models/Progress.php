<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Progress extends Model
{
    use HasFactory;

    protected $table = 'progress';

    protected $fillable = [

    'user_id',
    'score',
    'high_score',
    'last_soal_id',
    'level',
    'combo',
    'last_index',
    'health',
    'login_streak',
    'last_claim'

];
    /*
    |--------------------------------------------------------------------------
    | RELASI USER
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}