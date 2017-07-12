<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $primaryKey='commentID';
    protected $table='comments';
    public $fillable=['contetn','postID','userID'];
}
