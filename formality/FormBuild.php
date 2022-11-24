<?php

namespace Formality\Service;

use Elemental\Route\Request;

class FormBuild{
 

    /**
     * Construct a html
     * string from the object
     * and the callback function
     * in the /forms/ folder.
     */

    public function construct(object $object, array $results = []){

        /**
         * Reasons for the callback
         * not to be executed:
         */

        
        if(!isset($object->callback)){ return; }
        if(!function_exists($object->callback)){ return; }

        if(isset($results[$object->fieldname])){ $result = $results[$object->fieldname]; }else{ $result = ''; }
        /**
         * Execute the callback
         * as a function:
         */
        
        $cb = $object->callback;
        return $cb($object, $result);


    }

}