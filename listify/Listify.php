<?php

namespace Formality;

use Formality\Service\ListBuild;
use Formality\Service\ListParams;

class Listify{
 /** build lists */ 

    /**
     * The types of content
     * delivery available.
     */

    public static function table(object $object, array $result = []){ 

        if(!isset($object->list)){ return; }
        
        //dump(['table',$object->list,$result]); 

        $col = new ListBuild($object->list, $result);
        $col->type('table');

        $html[] = $col->header();
        $html[] = $col->rows();
        $html[] = $col->footer();
        
        return $col->wrapper($html);
    
    }

    public static function profiles(object $object, array $result = []){ 
        
        //dump(['profiles',$object->list,$result]); 

        if(!isset($object->list)){ return; }

        $col = new ListBuild($object->list, $result);
        $col->type('profiles');

        $html[] = $col->rows();
        
        return $col->wrapper($html);
    
    }

    public static function blocks(object $object, array $result = []){ 
        
        //dump(['blocks',$object->list,$result]); 

        if(!isset($object->list)){ return; }

        $col = new ListBuild($object->list, $result);
        $col->type('blocks');

        $html[] = $col->rows();
        
        return $col->wrapper($html);
    
    }

    /**
     * The list building 
     * method.
     */

    public static function column(string $callback = 'cell', array $variables = []){

        $col = new ListParams;
        $col->callback($callback);
        $col->variables($variables);
        return $col;

    }
    
}

/**
 * Concept:
 * - have a list builder that poops out a table list / userlist (https://bluefantail.github.io/bulma-list/) / blocked post list (blocks next to eachother for roles for instance)
 * - Listify::table() / Listify::profile() / Listify::blocks();
 * - make every cell with a callback function so that custom callbacks can be made (like adding, subtracting or presenting data such as dates) and make that reusable. 
 * - Callbacks should be named table_cell(), block_cell(), profile_cell() so that they are interchangable.
 * - also i like the tabs above the list: https://bluefantail.github.io/bulma-list/, maybe something for the admin page so that only one button, 'users' is needed for the subcategory.
 * - does this gonna need a custom bulma extention?, would be nice!
 */