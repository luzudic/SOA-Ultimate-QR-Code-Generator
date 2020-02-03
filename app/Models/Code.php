<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Storage;
use URL;

class Code extends Model
{
    use SoftDeletes;

    public $table = 'codes';

    public $fillable = ['app_id', 'name', 'code', 'url', 'dated', 'status', 'created_at', 'updated_at', 'deleted_at'];

    public $appends = ['visits'];

    public $hidden = ['created_by', 'updated_by', 'deleted_by', 'updated_at', 'deleted_at'];

    public function app()
    {
        return $this->belongsTo('App\Models\App', 'app_id');
    }

    public function visitors()
    {
        return $this->hasMany('App\Models\Visitor', 'code_id');
    }

    public function getVisitsAttribute()
    {

        return $this->visitors()->count();
    }

    public function getCodeAttribute($value)
    {
        return URL::to(Storage::url('codes/' . $this->id . '/' . $value));
    }
}
