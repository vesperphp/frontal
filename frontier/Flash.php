<?php

namespace Frontier\Service;

use Config\Config;
use Logger\Log;


/**
 * Send a quick message to
 * each and any user by
 * using Flash.
 */

class Flash{

    /**
     * Register a flash message.
     */

    public static function set(string $message, string $position, string $severity = "info"){

        /**
         * Pull the flash message 
         * list from the tag class.
         * And add a new message 
         * to the array.
         */

        if(!isset($_SESSION['_flash'][$position])){ $_SESSION['_flash'][$position] = []; }

        $list = $_SESSION['_flash'][$position];
        $list[] = ['message'=>$message,'severity'=>$severity];
        
        /**
         * Add the array back to the 
         * flash tag session.
         */

        $_SESSION['_flash'][$position] = $list;

    }

    /**
     * Show flash messages on a certain 
     * position on the template file.
     */

    public static function front(string $position){

        /**
         * Where to find the template file:
         */

        $wrapper = file_get_contents(ROOTPATH.'/'.Config::get("frontier/flash/template"));

        /**
         * Put the message array
         * in a variable.
         */
        if(!isset($_SESSION['_flash'][$position])){ return; }

        $messages = $_SESSION['_flash'][$position];
        $html = "";
        $i = 0;

        foreach($messages as $mess){

            /**
             * Process each and every message
             * with the loaded tempalte.
             */
            
            $wrap = str_replace('{{ $id }}', $i, $wrapper);
            $wrap = str_replace('{{ $message }}', $mess['message'], $wrap);
            $wrap = str_replace('{{ $severity }}', $mess['severity'], $wrap);

            /**
             * Store the html in a string.
             */
            
            $html .= $wrap;
        }

        /** 
         * Echo that string
         */

        echo $html;

        $i++;

        unset($_SESSION['_flash'][$position]);
        
    }

}