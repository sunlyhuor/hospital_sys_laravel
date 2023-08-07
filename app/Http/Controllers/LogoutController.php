<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function index(Request $request){
        
        $ck1 = cookie( "isAdmin", false, -1 );
        $ck2 = cookie( "isLogin", false, -1 );
        $ck3 = cookie( "isData", "", -1 );
        $ck4 = cookie( "isDoctor", false, -1 );
        $ck4 = cookie( "isReceptionist", false, -1 );
        return response()->redirectTo("/login?message=Logout successfully")->withCookies([ $ck1, $ck2, $ck3, $ck4 ]);

    }
}
