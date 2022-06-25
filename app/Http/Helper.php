<?php

/**
     * Author           :         System Decoder
     * App Version      :         1.0.0
     * Email            :         contact@systemdecoder.com
     * Author URL       :         https://www.systemdecoder.com
 */

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

// Application Settings
if (!function_exists('sd_application_setting')) {
    function sd_application_setting($key): string
    {
        $setting = DB::table('application_settings')->where('key', $key)->first();
        if (!empty($setting)) {
            return $setting->value;
        }
        return "";
    }
}
