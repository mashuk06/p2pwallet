<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ExchangeRateController extends Controller
{
    public function index(Request $request){
        $current_user_currency = $request->currentUserCurrency;
        $other_user_currency = $request->otherUserCurrency;
        $response = Http::get('http://api.currencylayer.com/live?access_key=23fabde029d84fdcfd0d3c311cdc78a2&format=1');
        $result = $response->json();
        if($current_user_currency == 'USD'){
            $param = $current_user_currency.$other_user_currency;
            return $result['quotes'][$param];
        }else{
            //free api not support changing base currency //currencylayer.com
            $param = "USDEUR";
            return (1/$result['quotes'][$param]);
        }
    }
}
