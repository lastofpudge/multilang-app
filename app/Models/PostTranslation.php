<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class PostTranslation extends Model
{
    protected $table = 'posts_translations';

    public $timestamps = false;

    public $fillable = [];

}
