<?php
namespace App\Helpers;

class GeneralHelper{
  public function format_time_2digit($time){
    return date('H:i', strtotime($time));
  }

}
?>