<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ExchangeRateController extends Controller
{
    public function index(Request $request){
        $current_user_currency = $request->currentUserCurrency;
        $other_user_currency = $request->otherUserCurrency;
        $param = $current_user_currency.$other_user_currency;
        $response = Http::get('http://api.currencylayer.com/live?access_key=23fabde029d84fdcfd0d3c311cdc78a2&source='.$current_user_currency.'&currencies='. $other_user_currency.'&format=1');
        $result = $response->json();
        return $result['quotes'][$param];
    }
}
