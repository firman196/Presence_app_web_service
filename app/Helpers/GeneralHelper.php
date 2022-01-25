<?php
namespace App\Helpers;
use Carbon\Carbon;

class GeneralHelper{
  public static function format_time_2digit($time){
      return date('H:i', strtotime($time));
  }

   /**
    * helper untuk convert date ke tanggaal dalam format bahasa indonesia
    */
  public static function tgl_indo($tanggal){
      $bulan = array (
          1 =>   'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'
      );
      $pecahkan = explode('-', $tanggal);

      return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
  }


  public static function check_jam_presensi($presensi_dibuka,$presensi_ditutup,$toleransi){
    $time = Carbon::now();
    if(strtotime($presensi_dibuka)<= strtotime($time) && strtotime($time)<=strtotime('+'.$toleransi.' minutes', strtotime($presensi_ditutup))){
      return true;
    }else{
      return false;
    }
  }

}
?>