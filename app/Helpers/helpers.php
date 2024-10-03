<?php

use Illuminate\Support\Facades\Auth;

if(!function_exists('format_to_rp')){
    function format_to_rp(int $number) : string {
        $result = "Rp " . number_format($number,0,'','.');
        return $result;
    }
}

if(!function_exists('format_number')){
    function format_number(int $number) : string {
        $result = number_format($number,0,'','.');
        return $result;
    }
}

if(!function_exists('format_date_slug')){
    function format_date_slug(string $date): string {
        $date = new \DateTime($date);
        $formattedDate = $date->format('d_m_Y');
        return $formattedDate;
    }
}


if(!function_exists('meta_title_check')){
    function meta_title_check(string $role) : string {
        $currentRole = "";
        if(Auth::user()->role_id == 1){
            $currentRole = "Admin";
        } else if( Auth::user()->role_id == 2) {
            $currentRole = "TenizenBank";
        } else if ( Auth::user()->role_id == 3) {
            $currentRole = "Kantin";
        } else {
            $currentRole = "";
        }

        return $currentRole;
    }
}

if(!function_exists('generate_norec_number')){
     function generate_norec_number(){
        return str_pad(random_int(0, 99999999), 8, '0', STR_PAD_LEFT);
     }
}


?>
