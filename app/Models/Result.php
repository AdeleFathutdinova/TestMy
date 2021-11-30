<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $table = 'Results';
    public $timestamps = true;

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function test(){
        return $this->belongsTo('App\Models\Test');
    }

    public function userAnswers() {
        return $this->hasMany('App\Models\UserAnswer', 'result_id', 'id');
    }
}
