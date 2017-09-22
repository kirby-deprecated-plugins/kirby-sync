<?php
class SyncCore {
    function getContent($url) {
        $ch = curl_init();  
    
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 4);
        curl_setopt($ch, CURLOPT_TIMEOUT, 4);
     
        $output = curl_exec($ch);
     
        curl_close($ch);
        return $output;
    }
}