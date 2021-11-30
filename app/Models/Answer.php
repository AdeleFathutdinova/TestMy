<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    /**
   * Связанная с моделью таблица.
   *
   */
    protected $table = 'Answers';
    public $timestamps = false;

    public function question()
    {
        return $this->belongsTo('App\Models\Question');
    }
}
