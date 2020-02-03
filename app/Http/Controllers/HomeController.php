<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\App;
use App\Models\Code;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $user = $request->user();

        $app = new App();

        if ($user->user_type == 2) {
            $app = $app->whereUserId($user->id);
        }

        $this->data['Title'] = 'Home';
        $this->data['TotalApps'] = $app->count();

        $codes = 0;

        foreach ($app->get() as $key) {
            $codes += $key->codes->count();
        }

        $this->data['TotalCodes'] = $codes;

        if ($user->user_type == 1) {
            $this->data['TotalUsers'] = User::whereUserType(2)->count();
        }

        return view('home', $this->data);
    }
}
