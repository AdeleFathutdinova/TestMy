<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'Questions';
    public $timestamps = false;

    public function answers() {
        return $this->hasMany('App\Models\Answer', 'question_id', 'id');
    }

    public function correctCount() {
        return $this->answers()->where('correct', 1 )->count();
    }

    public function test() {
        return $this->belongsTo('App\Models\Test');
    }

    public function correctOptionsCount() {
        return $this->answers()->where('correct', 1 )->count();
    }
}
