<?php

namespace Frontier;

use Frontier\Service\Compiler;

/**
 * Mailer uses Compiler 
 * methods to build an 
 * email layout that
 * can be sent.
 */

class Mailer extends Compiler{


    public static function cache($file){

        /**
         * This is where the cached 
         * mail is built and
         * returned from.
         */

         return 'this should be an email';
         
    }

}