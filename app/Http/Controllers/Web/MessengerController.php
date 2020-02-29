<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use BotMan\BotMan\BotMan;
use Illuminate\Http\Request;

class MessengerController extends Controller
{
    public function example()
    {
        $text = 'Shop One is ';
        return $this->returnText($text);
    }

    public function getCurrencyValue(Request $request)
    {
        $currency_name = $request->header('currency');
        return $this->returnText($currency_name);
    }


    public function booking(Request $request)
    {
        $amount = $request->header('amount');
        $type = $request->header('type');
        $fb_profile_url = $request->header('profile_url');
        $fb_name = $request->header('name');
        $messenger_id = $request->header('user_id');
        $currency = $request->header('currency');

        $text = 'Dear '. $fb_name .', ' .'your booing number is ' . 0001 . ' for ' .$type.'ing '. $amount . ' of '
            . $currency;
        return $this->returnText($text);

    }

    protected function returnText($text)
    {
        $message = new \stdClass();
        $message->text = $text;
        return response()->json([
            'messages' => [
                $message
            ]
        ]);
    }
}
