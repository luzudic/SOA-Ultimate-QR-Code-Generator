<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\Http\Request;
use App\Models\Code;
use App\Helpers\Helper;

class GuestController extends Controller
{
    public function redirect($id)
    {
       $location = Helper::get_user_location();

        $q = Code::find($id);

        $v = new Visitor();
        $v->code_id = $q->id;
        $v->ip = $location['ip'];
        $v->city = $location['city'];
        $v->region = $location['region'];
        $v->country = $location['country'];
        $v->loc = $location['loc'];
        $v->postal = $location['postal'];
        $v->timezone = $location['timezone'];
        $v->save();

        return redirect($q->url);
    }
}
