<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use BotMan\BotMan\BotMan;
use Illuminate\Http\Request;

class MessengerController extends Controller
{

    public $branch1 = '-Main Shop- No(74)၊မနော်ဟရီလမ်း၊ ထိုင်းသံရုံးဘေး၊ ဒဂုံမြို့နယ်။';
    public $branch2 =  '-Yankin Branch-အမှတ်(273)၊အခန်း(1)၊ရန်ကင်းလမ်းမ၊ရန်ကင်းမြို့နယ်။';
    public $branch3 =  '-8-mile Branch-No(107/B) ၈မိုင်၊ Junction 8 ၏ အရှေ့၊ ၆ ရပ်ကွက်၊မရမ်းကုန်းမြို့နယ်။';
    public $branch4 = '-North Okkalapa Branch -No.(355),ဝဇီရာ (၆)လမ်း.မြောက်ဉကလာပ ​မြို့နယ်.ရန်ကုန်';
    public function getBranches()
    {
        $text = $this->branch1 ."\r\n" . $this->branch2 ."\r\n" . $this->branch3 ."\r\n" . $this->branch4
        ;
        return $this->returnText($text);
    }

    public function getCurrencyValue(Request $request)
    {
        $currency_name = $request->header('currency');
        $text = $currency_name ."\r\n" . 'Selling Value : ' . 1350 . "\r\n" . 'Buying Value : ' . 1300 ;
        return $this->returnText($text);
    }


    public function booking(Request $request)
    {
        $amount = $request->header('amount');
        $type = $request->header('type');
        $fb_profile_url = $request->header('profile_url');
        $fb_name = $request->header('name');
        $messenger_id = $request->header('user_id');
        $currency = $request->header('currency');
        $branch = $request->header('branch');

        $text = 'Dear '. $fb_name .', ' .'your booing number is ' . 0001 . ' for ' .$type.'ing '. $amount . ' of '
            . $currency .' at '. $branch;
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
