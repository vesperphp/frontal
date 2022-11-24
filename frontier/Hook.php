<?php 

namespace Frontier\Service;


class Hook{

    /**
     * Fetch something from
     * the Hook.
     */

    public static function get($location){

        /**
         * First create an array
         * from the shorthand.
         * and store the Hook session.
         */

        $hook = $_SESSION['V_HOOK'];

        /**
         * Is the hook set?
         * then continue.
         */

        if(!isset($_SESSION['V_HOOK'])){
            return false;
        }

        /**
         * Filter all the 
         * needed hooked
         * rows.
         */

        foreach($hook as $key => $val){

           if(isset($val['location']) && $val['location'] == $location){
              $n[$key] = $val;
           }
        }

        /** 
         * All done,
         * return the found
         * value.
         */

        return $n;

    }

    /**
     * This is the hook that 
     * prints on the templates
     * and is used by Frontier.
     */

    public static function frontier($position = "head"){
        
        /**
         * Is the hook set?
         * then continue.
         */

        if(!isset($_SESSION['V_HOOK'])){
            return false;
        }

        /**
         * Gather the position
         * information.
         */

        $hooks = Hook::get($position);
        $hooks = Hook::sort($hooks);

        // order here
        foreach($hooks as $hook){
            /**
             * Check if the class
             * exists and continue.
             */
            if(class_exists($hook['value'][0])){
                 
                /**
                 * Fetch the Controller
                 */

                $paint = new $hook['value'][0];
  
                /**
                 * Fetch the Method
                 * and make sure
                 * it exists.
                 */

                $method = $hook['value'][1];
                $paint->$method();
                echo "\n";
    
            }
            
        }
        
    }

    public static function sort($array){

        foreach ($array as $key => $row) {
            $col[$key]  = $row['order'];
        }
        
        // you can use array_column() instead of the above code
        $col  = array_column($array, 'order');
        
        // Sort the data with volume descending, edition ascending
        // Add $data as the last parameter, to sort by the common key
        array_multisort($col, SORT_ASC, $array);

        return $array;
    }

    /**
     * Register an asset
     * for being used by
     * Frontier
     */

    public static function asset($hooked, $key, $array = [], $order = 50){

        Hook::set($hooked, $array, $key, $order);

    }

    /**
     * Set a value to a hook
     * by using an shorthand 
     * identifier and a value.
     */

    public static function set($location, $value, $key, $order = 50,  ){

        $hook['location'] = $location;
        $hook['key'] = $key;
        $hook['value'] = $value;
        $hook['order'] = $order;
        $_SESSION['V_HOOK'][$key] = $hook;   

    }

    /**
     * Clear the hooked information
     */

     public static function clear(){

        unset($_SESSION['V_HOOK']);

     }

}