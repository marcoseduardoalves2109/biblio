<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    //
    protected $fillable = ['title', 'description','image'];
    public function authors(){
        return $this->belongsToMany('App\models\Authors','author_book','book_id','author_id');
    }


    public function lendings(){
        return $this->belongsToMany('App\models\Lendings','book_lending','book_id','lending_id');
    }
}
