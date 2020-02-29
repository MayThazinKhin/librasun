<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use BotMan\BotMan\BotMan;
use Illuminate\Http\Request;

class MessengerController extends Controller
{
    public function example()
    {
        $a = new \stdClass();
        $a->text = 'mother fucker';
        return $this->returnText($a);
    }

    public function getCurrencyValue(Request $request)
    {
        $currency_name = $request->header('currency');
        $currency = new \stdClass();
        $currency->text = $currency_name;
        return $this->returnText($currency);
    }

    protected function returnText($text)
    {
        return response()->json([
            'messages' => [
                $text
            ]
        ]);
    }
}
