<?php

namespace App\Http\Models\Developers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LevelsModel extends Model
{
    protected $table = 'levels';

    use SoftDeletes;

    protected $fillable = [
        'id', 'nivel'
    ];

    protected $hidden = ['deleted_at'];

    protected $dates = ['deleted_at', 'created_at', 'update_at'];
}
