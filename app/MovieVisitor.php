<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MovieVisitor extends Model
{
    protected $table = 'movie_visitor';
//    protected $fillable = ['visitor_id', 'movie_id'];
    public $timestamps = false;
}
