<?php

namespace App\Http\Controllers;

use App\Models\Advertising;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use function PHPUnit\Framework\fileExists;


class AdvertisingController extends Controller
{



    public function store(Request $request)
    {
        $imageName = uniqid() . '.' . $request->advertisingImage->getClientOriginalExtension();
        $imagePath = '/uploads/' . $imageName;
        $request->advertisingImage->move(public_path('uploads'), $imageName);

        $Advertising = Advertising::create([
            'advertisingImage' => $imagePath,
            'advertisingUrl' => $request->advertisingUrl,
            'advertisingCount' => $request->advertisingCount

        ]);
        return json('success' , [] , [$Advertising]);

//        return json('success', [$Advertising]);
    }

// /===============================================================================/ //
    public function edit(Request $request, $id)
    {
        $Advertising = Advertising::query()->where('id', $id)->first();
        if ($request->advertisingImage) {
            if ($Advertising->advertisingImage)

                if (fileExists(public_path() . $Advertising->advertisingImage)) {
                    File::delete(public_path() . $Advertising->advertisingImage);
                }
            $imageName = uniqid() . '.' . $request->advertisingImage->getClientOriginalExtension();
            $imagePath = '/uploads/' . $imageName;
            $request->advertisingImage->move(public_path('uploads'), $imageName);
            $Advertising->update([   'advertisingImage' => $imagePath,]);
        }
        $Advertising->update([
            'advertisingUrl' => $request->advertisingUrl,
            'advertisingCount' => $request->advertisingCount

        ]);
        return json('success' , [] , [$Advertising]);

//        return response()->json($Advertising);
    }
// /===============================================================================/ //
    public function delete($id){
        $Advertising = Advertising::query()->where('id', $id)->first();
        if($Advertising->advertisingImage){
            File::delete(public_path() .$Advertising->advertisingImage);
        }
        $Advertising->delete();
        return json('success' , [] , []);
    }
// /===============================================================================/ //
    public  function getAllAdvertising(){
       $Advertising= Advertising::query()->get();
        return json('success' , [] , $Advertising);
    }
}
