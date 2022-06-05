<?php

namespace App\Utils;

class AppUtils 
{
    public static function getCurrentDate($pattern) {
        date_default_timezone_set('Europe/Warsaw');
        return date($pattern, time());
    }
}