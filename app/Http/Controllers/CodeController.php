<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\App;
use App\Models\Code;

class CodeController extends Controller
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

        $this->data['Title'] = 'List Codes';

        $this->data['App'] = App::whereUserId($user->id)->whereId($request->id)->first();

        if (!$this->data['App']) {
            return back()->with('error', 'Record Not Found');
        }

        return view('list-code', $this->data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $this->data['Title'] = 'View Code';

        $code = Code::find($id);

        if (!$code) {
            return back()->with('success', 'Record Not Found');
        }

        $this->data['Code'] = $code;

        return view('code.show', $this->data);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->data['Title'] = 'Edit Code';

        $code = Code::find($id);

        if (!$code) {
            return back()->with('success', 'Record Not Found');
        }

        $this->data['Code'] = $code;

        return view('code.edit', $this->data);
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
            'url' => 'required|url',
            'name' => 'required|string|max:50',
        ];

        $request->validate($fieldsToValidate);

        $code = Code::find($request->id);
        $code->url = $request->url;
        $code->name = $request->name;
        $code->save();

        return back()->with('success','Record Has Been Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
