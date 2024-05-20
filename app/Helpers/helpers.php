<?php

if(!function_exists('format_to_rp')){
    function format_to_rp(int $number) : string {
        $result = "Rp " . number_format($number,0,'','.');
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


?>
