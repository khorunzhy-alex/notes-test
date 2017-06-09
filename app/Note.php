<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = [
        'title',
        'text'
    ];

    public function images(){
        return $this->hasMany('App\NoteImage');
    }
}