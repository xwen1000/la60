<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdminUser extends Model
{
    //
    public static function getAuthor($authorId)
    {
        return self::find($authorId)->name;
    }
}
