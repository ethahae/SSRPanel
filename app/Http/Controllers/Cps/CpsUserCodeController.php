<?php

namespace App\Http\Controllers\CPS;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\CpsUserCode;
use Auth;

class CpsUserCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $codes = CpsUserCode::where('user_id', Auth::user()->id());
        Response::json(['code' => 20000, 'data' => $codes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     $code = CpsUserCode::updateOrCreate($request->only('code', 'comment'));
    //     Response::json(['code' => 20000, 'data' => $code, 'message' => 'ok']);
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $code = CpsUserCode::where('user_id', Auth::user()->id(), 'id', $id);
        if (!empty($code)){
            Response::json(['code' => 20000, 'data' => $code, 'message' => 'ok']);
        } else {
            Response::json(['code' => 20001, 'data' => [], 'message' => 'no code found']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $code = CpsUserCode::where('user_id', Auth::user()->id(), 'id', $id);
        if (empty($code)) {
            Response::json(['code' => 20001, 'data' => [], 'message' => 'invalid code id']);
        } else {
            $data = $request->only('code', 'comment');
            $code->fill($data);
            $code->save();
            Response::json(['code' => 20000, 'data' => $code, 'message' => 'ok']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $code = CpsUserCode::where('user_id', Auth::user()->id(), 'id', $id);
        if (!empty($code)){
            CpsUserCode::destroy($id);
        }
    }
}
