<?php
class U
{
    public static function Filled($string){
         $string = trim($string);
         if(is_numeric($string)) return TRUE;
         return !empty($string);
    }
}
?>
