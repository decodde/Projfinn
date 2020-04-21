<?php

namespace App\Http\Helpers;
use Stillat\Numeral\Languages\LanguageManager;
use Stillat\Numeral\Numeral;
use Carbon\Carbon;

class Formatter{

    public static function MoneyConvert($cash, $type = null){
        $languageManager = new LanguageManager;
        // Create the Numeral instance.

        $formatter = new Numeral;
        // Now we need to tell our formatter about the language manager.

        $formatter->setLanguageManager($languageManager);

        if($type == "full"){
            $string = $formatter->format($cash, '0,0.00');
        }
        else {
            $string = $formatter->format($cash, '0,0a');
        }
        return $string;
    }

    public static function dataTime($data){
        $date = Carbon::parse($data);
        return $date->toDayDateTimeString('MMMM Do YYYY, h:mm:ss a');
    }

    public static function singular($data){
        $date = Carbon::parse($data);
        return $date->diffForHumans();
    }

}
