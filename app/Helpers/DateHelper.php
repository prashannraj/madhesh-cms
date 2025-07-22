<?php

namespace App\Helpers;

use Carbon\Carbon;

class DateHelper
{
    public static function engToNepaliDate($date)
    {
        $nepaliDate = Carbon::parse($date)->addYears(56)->addMonths(8)->addDays(17);
        return $nepaliDate->format('Y-m-d');
    }

    public static function toNepaliNumber($number)
    {
        $eng = ['0','1','2','3','4','5','6','7','8','9'];
        $nep = ['०','१','२','३','४','५','६','७','८','९'];
        return str_replace($eng, $nep, $number);
    }
}
