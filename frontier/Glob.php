<?php

namespace Frontier\Service;


class Glob{

    public static function al(string $path, bool $echo = false){



    require_once ROOTPATH.'/init/globals.php';

    /**
     * Check if the parent and 
     * child are available..
     */

    if($path) {

        $path = explode('/', $path);
        $global = V_GLOBAL;
        
        foreach($path as $bit) {

            if(isset($global[$bit])) {
                $global = $global[$bit];
            }

        }
        
        if($echo==false){
            return $global;
        }else{
            echo $global;
        }

    }
    
    if($echo==false){
        return false;
    }

}
    
}
