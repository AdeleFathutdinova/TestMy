<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $table = 'Tests';
    public $timestamps = true;

    public function questions() {
        return $this->hasMany('App\Models\Question', 'test_id', 'id');
    }
}
