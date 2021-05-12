<?php

namespace App\Http\Controllers;

use App\Models\Statistice;
use Illuminate\Http\Request;

class StatisticeController extends Controller
{
    public function store(Request $request)
    {
        $Statistice = Statistice::create([
        'installApplication' => $request->installApplication,
        'onlineApplication' => $request->onlineApplication,
        'startUsingApplication' => $request->startUsingApplication,
        'endUsingApplication' => $request->endUsingApplication,
        'startInstallApplication' => $request->startInstallApplication,

    ]);
        return json('success' , [] , [$Statistice]);

//        return json('success', [$Statistice]);
    }
// /===============================================================================/ //

    public function edit(Request $request,$id)
    {
        $Statistice = Statistice::query()->find($id);
        $Statistice ->update([
        'installApplication' => $request->installApplication,
        'onlineApplication' => $request->onlineApplication,
        'startUsingApplication' => $request->startUsingApplication,
        'endUsingApplication' => $request->endUsingApplication,
        'startInstallApplication' => $request->startInstallApplication,

    ]);
        return json('success' , [] , [$Statistice]);

//        return response()->json($Statistice);
    }
// /===============================================================================/ //
    public function destroy($id)
    {
        $Statistice = Statistice::query()->findOrFail($id);
        $Statistice->delete();
        return json('success' , [] , []);

    }
    // /===============================================================================/ //
    public function getStatisticeById($id){
        $Statistice = Statistice::query()->find($id)->first();
        return json('success' , [] , $Statistice);

    }
    // /===============================================================================/ //
    public function getAllStatistices(){
        $Statistice = Statistice::query()->get();
        return json('success' , [] , $Statistice);
    }
    // /===============================================================================/ //
    public function getCountInstallApplication(){
        $Statistice = Statistice::query()->where('installApplication' ,1)->get()->count();
        return json('success' , [] , $Statistice);
    }
    // /===============================================================================/ //
    public function getCountOnlineApplication(){
        $Statistice = Statistice::query()->where('onlineApplication' ,1)->get()->count();
        return json('success' , [] , $Statistice);
    }
    // /===============================================================================/ //
}
