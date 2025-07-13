<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BranchController extends Controller
{
    public function nearest(Request $request){
        $lat =$request->query('latitude');
        $lng = $request->query('longitude');
        $nearest = DB::table('branches')
        ->select(
            'id', 'name', 'location', 'longitude','latitude',DB::raw("
            (6371*acos(
            cos(radians(?))*
            cos(radians(latitude))*
            cos(radians(longitude) -radians(?))+
            sin(radians(?))*
            sin(radians(latitude))
            )) As distance")
        )
        ->orderBy('distance')
        ->limit(1)
        ->setBindings([$lat, $lng, $lat])
        ->first();
        return response()->json($nearest);
    }
}
