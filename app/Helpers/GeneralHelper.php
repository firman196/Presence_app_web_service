<?php
namespace App\Helpers;

class GeneralHelper{

    public static function buat_thumbnail($file_src, $file_dst) {
        //-- hapus jika thumbail sebelumnya dah ada
        list($w_src,$h_src,$type) = getImageSize($file_src);
        
        switch ($type)     {
           case 1:   //   gif -> jpg
             $img_src = imagecreatefromgif($file_src);
             break;
           case 2:   //   jpeg -> jpg
             $img_src = imagecreatefromjpeg($file_src);
             break;
           case 3:  //   png -> jpg
             $img_src = imagecreatefrompng($file_src);
             break;
          }
        
         $thumb = 100;  //--- max. size untuk thumb ---
         if ($w_src > $h_src) {
               $w_dst = 300;
               $h_dst = 200;
         } else {
               $w_dst = 200;
               $h_dst = 300;
         }
       
        $img_dst = imagecreatetruecolor($w_dst, $h_dst);  //  resample
         
        imagecopyresampled($img_dst, $img_src, 0, 0, 0, 0, $w_dst, $h_dst, $w_src, $h_src);
        imagejpeg($img_dst, $file_dst);    //  simpan thumbnail
         //-- bersihkan memori
        imagedestroy($img_src);       
        imagedestroy($img_dst);
     }

}
?>