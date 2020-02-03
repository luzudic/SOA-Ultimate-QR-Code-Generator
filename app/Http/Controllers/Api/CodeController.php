<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\App;
use App\Models\Code;
use App\Rules\VerifyAppSecretKey;
use App\Rules\VerifyAppCodeId;
use SimpleSoftwareIO\QrCode\Facades\QrCode as QR;
use Storage;

class CodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $request->validate([
            'app_key' => ['required', 'string', 'exists:apps,app_key'],
            'secret_key' => ['required', 'string', new VerifyAppSecretKey($request->app_key)],
        ]);

        $result = App::with('codes')->whereAppKey($request->app_key)->first();

        if(!$result->codes){
            return response()->json([
                'message' => 'Record not found.'
            ], 404);
        }

        return response()->json($result->codes);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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

        $request->validate([
            'app_key' => ['required', 'string', 'exists:apps,app_key'],
            'secret_key' => ['required', 'string', new VerifyAppSecretKey($request->app_key)],
            'name' => ['required', 'string', 'max:50'],
            'url' => ['required', 'url'],
            'code_size' => ['required', 'numeric'],
        ]);

        $app = App::whereAppKey($request->app_key)->first();

        $code = new Code();
        $code->app_id = $app->id;
        $code->url = $request->url;
        $code->name = $request->name;
        $code->dated = date('Y-m-d');
        $code->code = "image.png";
        $code->created_by = $user->id;
        $code->updated_by = $user->id;
        $code->save();

        $result = QR::format('png')->size($request->code_size)->generate(url('/redirect/' . $code->id));
        Storage::put('public/codes/' . $code->id . '/image.png', (string)$result);

        return response()->json([
            'qr_code' => $code->code
        ], 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $user = $request->user();

        $fieldsToValidate = [
            'app_key' => ['required', 'string', 'exists:apps,app_key'],
            'secret_key' => ['required', 'string', new VerifyAppSecretKey($request->app_key)],
            'code_id' => ['required', 'integer', 'exists:codes,id', new VerifyAppCodeId($request->app_key, $request->secret_key)],
        ];

        $request->validate($fieldsToValidate);

        $code = Code::with(['app', 'visitors'])->whereId($request->code_id)->first();

        if (!$code) {
            return response()->json([
                'message' => 'Record not found.'
            ], 404);
        }

        return response()->json($code, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
            'app_key' => ['required', 'string', 'exists:apps,app_key'],
            'secret_key' => ['required', 'string', new VerifyAppSecretKey($request->app_key)],
            'id' => ['required', 'integer', 'exists:codes,id', new VerifyAppCodeId($request->app_key, $request->secret_key)],
            'url' => ['required', 'url'],
            'name' => ['required', 'string', 'max:50'],
        ];

        $request->validate($fieldsToValidate);

        $code = Code::whereId($request->id)->first();

        if (!$code) {
            return response()->json([
                'message' => 'Record not found.'
            ], 404);
        }

        $code->url = $request->url;
        $code->name = $request->name;
        $code->save();

        return response()->json($code, 200);
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
