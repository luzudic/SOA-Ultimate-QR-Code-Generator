<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\App;
use Auth;

class AppController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();

        $this->data['Title'] = 'My Apps';

        $this->data['Apps'] = App::whereUserId($user->id)->orderBy('id', 'desc')->get();

        return view('list-app', $this->data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->data['Title'] = 'Create App';

        return view('app-create', $this->data);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = $request->user();

        $fieldsToValidate = [
            'name' => 'required|string|max:50',
            'description' => 'required|string|max:180',
            'domain' => 'required|url'
        ];

        $request->validate($fieldsToValidate);

        $newApp = new App();
        $newApp->user_id = $user->id;
        $newApp->name = $request->name;
        $newApp->description = $request->description;
        $newApp->domain = $request->domain;
        $newApp->created_by = $user->id;
        $newApp->updated_by = $user->id;
        $newApp->save();

        $newApp->app_key = md5($newApp->id . time());
        $newApp->secret_key = bcrypt($user->id . '|' . $request->name . '|' . $request->description . '|' . $request->domain . '|' . $newApp->id);
        $newApp->save();

        return back()->with('success', "App Has Been Created!");

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();

        $result = App::whereUserId($user->id)->whereId($id)->first();

        if (!$result) {
            return back()->with('error', 'Record Not Found');
        }

        $this->data['Title'] = 'View App';
        $this->data['App'] = $result;

        return view('app-show', $this->data);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();

        $result = App::whereUserId($user->id)->whereId($id)->first();

        if (!$result) {
            return back()->with('error', 'Record Not Found');
        }

        $this->data['Title'] = 'Edit App';
        $this->data['App'] = $result;

        return view('app-edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = $request->user();

        $fieldsToValidate = [
            'id' => 'required|integer',
            'name' => 'required|string|max:50',
            'description' => 'required|string|max:180',
            'domain' => 'required|url'
        ];

        $request->validate($fieldsToValidate);

        $app = App::whereUserId($user->id)->whereId($request->id)->first();

        if (!$app) {
            return back()->with('error', 'Record Not Found');
        }

        $app->user_id = $user->id;
        $app->name = $request->name;
        $app->description = $request->description;
        $app->domain = $request->domain;
        $app->updated_by = $user->id;
        $app->save();

        return redirect('app/show/' . $app->id)->with('success', "App Has Been Updated!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user();

        $result = App::whereUserId($user->id)->whereId($id)->first();

        if (!$result) {
            return back()->with('error', 'Record Not Found');
        }

        $result->delete();

        return redirect('app')->with('success', 'App Has Been Deleted!');
    }
}
