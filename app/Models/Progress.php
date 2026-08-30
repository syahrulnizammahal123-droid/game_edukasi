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
    'total_xp',
    'last_soal_id',
    'level',
    'combo',
    'last_index',
    'health',
    'login_streak',
    'last_claim',
    'total_play',
    'correct_answer',
    'wrong_answer'

];

    protected $casts = [
        'score' => 'integer',
        'high_score' => 'integer',
        'total_xp' => 'integer',
        'level' => 'integer',
        'combo' => 'integer',
        'last_index' => 'integer',
        'health' => 'integer',
        'login_streak' => 'integer',
        'last_claim' => 'date',
        'total_play' => 'integer',
        'correct_answer' => 'integer',
        'wrong_answer' => 'integer',
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
