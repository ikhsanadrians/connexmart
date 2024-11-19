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
if(!function_exists('format_status')){
    function format_status(String $status){
        $class = '';
        
        switch($status) {
            case 'unconfirmed':
                $class = 'bg-yellow-100 text-yellow-800 px-2 py-1 rounded-md';
                break;
            case 'confirmed':
                $class = 'bg-green-100 text-green-800 px-2 py-1 rounded-md';
                break;
            case 'rejected':
                $class = 'bg-red-100 text-red-800 px-2 py-1 rounded-md';
                break;
            default:
                $class = 'bg-gray-100 text-gray-800 px-2 py-1 rounded-md';
        }

        return $class;
    }
}

if(!function_exists('format_status_get_name')){
    function format_status_get_name($status){
        switch($status) {
            case 'unconfirmed':
                $class = 'bg-yellow-100 text-yellow-800 px-2 py-1 rounded-md';
                break;
            case 'confirmed':
                $class = 'bg-green-100 text-green-800 px-2 py-1 rounded-md';
                break;
            case 'rejected':
                $class = 'bg-red-100 text-red-800 px-2 py-1 rounded-md';
                break;
            default:
                $class = 'bg-gray-100 text-gray-800 px-2 py-1 rounded-md';
        }

        return $class;

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


if(!function_exists('generate_keterangan_stok')){
    function generate_keterangan_stok(String $msg_type, Array $data = []){
        $finalMessage = "";

        if($msg_type == "init"){
            $finalMessage = "STOK AWAL PRODUK BARU TGL:" . now();
        } else if ($msg_type == "transaction"){
            $finalMessage = "Pembelian Produk No Transaksi:" . $data["notransaksi"] . "TGL:" . now();
        } else if ($msg_type == "addition_stock"){
            $finalMessage = "Penambahan Stok Baru TGL:" . now();
        }

        return $finalMessage;

    }
}


?>
