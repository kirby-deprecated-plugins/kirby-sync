<?php
namespace KirbySync;
use c;

class Core {    
    // Get object
    function getObject($parent_uid) {
        if($parent_uid != '')
            return site()->find($parent_uid);
        else
            return site()->pages();
    }

    // Create page
    function createPage($object, $page_id, $template, $data) {
        return $object->children()->create($page_id, $template, $data);
    }

    // Get remote content
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