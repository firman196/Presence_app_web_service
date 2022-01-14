<?php
namespace App\Helpers;

class GeneralHelper{
  public function format_time_2digit($time){
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

}
?>