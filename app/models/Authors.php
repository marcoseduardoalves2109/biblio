<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Authors extends Model
{
    protected $fillable  = ['name', 'description'];
    public function books(){
        return $this->belongsToMany('App\Models\Books', 'author_book','author_id','book_id');
    }
    

}

