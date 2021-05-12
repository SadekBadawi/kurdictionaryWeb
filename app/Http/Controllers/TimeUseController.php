<?php

namespace App\Http\Controllers;

use App\Models\Models\timeUse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TimeUseController extends Controller
{

    public function storeTimeUser(Request $request)
    {
        $time = timeUse::find($request->id);
        $active = $time->active;
        $houres = $time->houres;
        $minute = $time->minute;

        $activeNew = $active + $request->active;
        $houresNew = $houres + $request->houres;
        $minuteNew = $minute + $request->minute;

        if ($minuteNew >= 60) {
            $minuteTotal = $minuteNew - 60;
            $houresTotal = $houresNew + 1;
            $time->update([
                'active' => $activeNew,
                'houres' => $houresTotal,
                'minute' => $minuteTotal,
            ]);
        } else {
            $time->update([
                'active' => $activeNew,
                'houres' => $houresNew,
                'minute' => $minuteNew,
            ]);
        }

        return json('success', ['edit time successfully'], $time);
    }
    ////////بين وقتين//////
    public function getTimeUser(Request $request)
    {
        $time = DB::table('time_uses')
            ->where('time_uses.id', '>=', $request->start)->where('time_uses.id', '<=', $request->end)
            ->selectRaw("SUM(time_uses.active) AS active")
            ->selectRaw("SUM(time_uses.houres) AS houres")
            ->selectRaw("SUM(time_uses.minute) AS minute")->first();
        // dd($time->active);
        $active = $time->active;
        $minute = $time->minute;
        $houres = $time->houres;
        if ($minute >= 60) {
            $minuteTotal = $minute % 60;
            $houresTotal = $minute / 60;
            $houresTotal = $houres + (int)$houresTotal;

            $time = [
                'active' => $active,
                'houres' => $houresTotal,
                'minute' => $minuteTotal,
            ];
        } else {
            $time = [
                'active' => $active,
                'houres' => $houres,
                'minute' => $minute,
            ];
        }

        return json('success', [], $time);
        // dd($time);
    }

    public function index()
    {
        //
    }

    public function create()
    {

       
    }


    public function store(Request $request)
    {
        $time = timeUse::create([
            'active' => $request ->active,
            'houres'=> $request ->houres,
            'minute'=> $request->minute
        ]);
        return json('success', ['add time successfully'], $time);
    }


    public function show(timeUse $timeUse)
    {
        //
    }

    public function edit(timeUse $timeUse)
    {
        //
    }


    public function update(Request $request, timeUse $timeUse)
    {
        //
    }


    public function destroy(timeUse $timeUse)
    {
        //
    }
}
