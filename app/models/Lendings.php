<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Lendings extends Model
{
    //
    protected $fillable = ['user_id', 'date_start','date_end','date_finish'];
    public function books(){
        return $this->belongsToMany('App\models\Books', 'book_lending','lending_id','book_id');
    }
}
