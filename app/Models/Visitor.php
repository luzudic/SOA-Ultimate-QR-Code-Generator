<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Visitor extends Model
{
    use SoftDeletes;

    public $table = 'visitors';

    public $fillable = ['code_id', 'ip', 'city', 'region', 'country', 'loc', 'postal', 'timezone'];

    public function code()
    {
        return $this->belongsTo('App\Models\Code', 'code_id');
    }

    public function getLocAttribute($value)
    {
        return explode(',', $value);
    }


}
