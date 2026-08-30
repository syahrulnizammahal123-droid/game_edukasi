<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameHistory extends Model
{
    use HasFactory;

    protected $table = 'game_histories';

    protected $fillable = [

        'user_id',
        'level',
        'score',
        'grade',
        'correct_answer',
        'wrong_answer',
        'total_question',
        'accuracy',
        'xp_earned',
        'played_at'

    ];

    protected $casts = [
        'level' => 'integer',
        'score' => 'integer',
        'correct_answer' => 'integer',
        'wrong_answer' => 'integer',
        'total_question' => 'integer',
        'accuracy' => 'integer',
        'xp_earned' => 'integer',
        'played_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
