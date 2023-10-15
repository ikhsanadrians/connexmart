<?php

if(!function_exists('format_to_rp')){
    function format_to_rp(int $number) : string {
        $result = "Rp " . number_format($number,0,'','.');
        return $result;
    }
}


?>
