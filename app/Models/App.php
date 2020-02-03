<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class App extends Model
{
    use SoftDeletes;

    protected $table = 'apps';

    public $fillable = ['user_id', 'name', 'description', 'domain', 'aap_key', 'secret_key', 'status', 'created_by', 'updated_by', 'deleted_by'];

    public $hidden = ['created_by', 'updated_by', 'deleted_by', 'updated_at', 'deleted_at'];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function codes()
    {
        return $this->hasMany('App\Models\Code', 'app_id')->orderBy('id','desc');
    }
}
