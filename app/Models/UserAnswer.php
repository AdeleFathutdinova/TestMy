<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAnswer extends Model
{
    protected $table = 'User_answers';
    public $timestamps = false;

    public function result()
    {
        return $this->belongsTo('App\Models\Result');
    }
}
