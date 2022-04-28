<?php

namespace App\Http\Models\Developers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DevelopersModel extends Model
{
    protected $table = 'developers';

    use SoftDeletes;

    protected $fillable = [
        'id', 'nivel_id', 'nome', 'sexo', 'data_nascimento', 'idade', 'hobby'
    ];

    protected $hidden = ['deleted_at'];

    protected $dates = ['deleted_at', 'created_at', 'update_at'];
}
