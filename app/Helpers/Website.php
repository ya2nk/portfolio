<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

if (!function_exists('set_true')) {
    function set_true($uri, $output = 'true')
    {
        if (is_array($uri)) {
            foreach ($uri as $u) {
                if (Route::is($u)) {
                    return $output;
                }
            }
        } else {
            if (Route::is($uri)) {
                return $output;
            }
        }
    }
}

if (!function_exists('set_active')) {
    function set_active($uri, $output = 'active')
    {
        if (is_array($uri)) {
            foreach ($uri as $u) {
                if (Route::is($u)) {
                    return $output;
                }
            }
        } else {
            if (Route::is($uri)) {
                return $output;
            }
        }
    }
}

function kunjungan()
{
    $ip = $_SERVER['REMOTE_ADDR'];
    $tanggal = date("Y-m-d");
    $waktu = time();
    $cekk = DB::table('statistics')->where('ip', $ip)->where('tanggal', $tanggal);
    $rowh = $cekk->first();
    if ($cekk->count() == 0)
    {

        DB::table('statistics')
            ->insert(['ip' => $ip, 'tanggal' => $tanggal, 'hits' => 1, 'online' => $waktu]);

    }
    else
    {
        $hitss = $rowh->hits + 1;

        DB::table('statistics')
            ->where('ip', $ip)->where('tanggal', $tanggal)->update(['ip' => $ip, 'tanggal' => $tanggal, 'hits' => $hitss, 'online' => $waktu]);

    }
}

function kunjungan_detail()
{
    $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    DB::table('statistics_activity')->insert(['ip' => $_SERVER['REMOTE_ADDR'], 'url_visit' => $url, 'tanggal' => date('Y-m-d H:i:s') ]);

}

function grafik_kunjungan()
{
    return DB::select(DB::raw("SELECT count(*) as jumlah, DATE_FORMAT(tanggal,'%d-%M') AS day FROM `statistics` GROUP BY tanggal ORDER BY tanggal DESC LIMIT 7"));
}
function grafik_kunjungan_by_month($month, $tahun)
{
    //$count= DB::table('statistik')->select(DB::raw('*'))->where(DB::raw('MONTH(tanggal)'), '=',  ''.$month.'')->where(DB::raw('YEAR(tanggal)'), '=',  ''.$tahun.'')->groupBy('ip')->count();
    $count = DB::table('statistics')->where(DB::raw('MONTH(tanggal)') , '=', '' . $month . '')->where(DB::raw('YEAR(tanggal)') , '=', '' . $tahun . '')->count();
    return $count;
}

function grafik_kunjungan_by_year($tahun)
{
    $count = DB::table('statistics')->where(DB::raw('YEAR(tanggal)') , '=', '' . $tahun . '')->count();
    return $count;
}

function get_max_min_visitor_of_week($data)
{
    if ($data == "max")
    {
        /* $query = DB::select(DB::raw("SELECT MAX(x.jumlah) as jumlah_data,day FROM (
        (SELECT count(*) as jumlah, DATE_FORMAT(tanggal,'%d-%M') AS day FROM statistik GROUP BY tanggal ORDER BY tanggal DESC LIMIT 7)
        as x)")); */
        $query = DB::select(DB::raw("SELECT * FROM (
			SELECT count(*) as jumlah_data, tanggal FROM `statistics` GROUP BY tanggal ORDER BY tanggal DESC LIMIT 7
			   ) t WHERE jumlah_data = (SELECT MAX(t.jumlah_data) FROM 
			(SELECT count(*) as jumlah_data, tanggal FROM `statistics` GROUP BY tanggal ORDER BY tanggal DESC LIMIT 7) t)"));
    }
    else
    {
        /* $query = DB::select(DB::raw("SELECT MIN(x.jumlah) as jumlah_data,day FROM (
        (SELECT count(*) as jumlah, DATE_FORMAT(tanggal,'%d-%M') AS day FROM statistik GROUP BY tanggal ORDER BY tanggal DESC LIMIT 7)
        as x)")); */
        $query = DB::select(DB::raw("SELECT * FROM (
				SELECT count(*) as jumlah_data, tanggal FROM `statistics` GROUP BY tanggal ORDER BY tanggal DESC LIMIT 7
				   ) t WHERE jumlah_data = (SELECT MIN(t.jumlah_data) FROM 
				(SELECT count(*) as jumlah_data, tanggal FROM `statistics` GROUP BY tanggal ORDER BY tanggal DESC LIMIT 7) t)"));
    }

    return $query;
}