<?php 

namespace Frontier;

use Config\Config;
use Logger\Log;
use Frontier\Service\Compiler;

/**
 * Frontier is the templating
 * engine of Vesper. Simple and
 * I hope elegant enough to
 * work well and be useful..
 */

class Frontier{

    static $pathCache;
    static $pathViews;
    static $cache; 

    /**
     * The static view function
     */

    static function view(string $file, array $data = array()) {

        /**
         * Pull the view (cached php) from the
         * Cache folder. If there isn't any,
         * Take care of it..
         */

        $view = self::cache($file);

        /**
         * Extract the array of data and turn them
         * into regular variables from now on.
         */

        extract($data, EXTR_SKIP);
        
        /**
         * Is the file available? 
         * Then require the file.
         * Otherwise throw E_COMPILE_ERROR
         */
        
        require $view;

        /**
         * The template should be populated
         * and painted right now.
         */
        
    }

    static function mail(string $file, array $data = array()) {

        /**
         * Pull the view (cached php) from the
         * Cache folder. If there isn't any,
         * Take care of it..
         */

        $view = Mailer::cache($file);

        /**
         * Extract the array of data and turn them
         * into regular variables from now on.
         */

        extract($data, EXTR_SKIP);
        
        /**
         * Is the file available? 
         * Then require the file.
         * Otherwise throw E_COMPILE_ERROR
         */
        
        require $view;

        /**
         * The template should be populated
         * and painted right now.
         */
        
    }

   static function cache(string $file) {

        self::$pathCache = ROOTPATH.'/'.Config::get('frontier/cache');
        self::$pathViews = ROOTPATH.'/'.Config::get('frontier/views');
        self::$cache = Config::get('production'); 

        /**
         * Check if the cache folder exists
         * and if not, create a cache folder
         * on that spot (see config)
         */

        if (!file_exists(self::$pathCache)) { mkdir(self::$pathCache, 0744); }
        
        /**
         * Set up a proper string (dir_file.php)
         * for the cached file. This will become
         * a PHP file.
         */

        $fileName = str_replace(array('/', '.html'), array('_', ''), $file . '.php');
        $fileCache = self::$pathCache . $fileName; 
        $fileViews = self::$pathViews . $file;

        /**
         * Let's do a check if the parameters are met and
         * we are good to go on creating a new cached file:
         * 
         * - Check if production mode is off.
         * - Check if the file already exists.
         * - Check if the cached file is older (smaller)
         *   than the template file.
         */

        if (self::$cache || !file_exists($fileCache) || filemtime($fileCache) < filemtime($fileViews)) {
            
            /**
             * Pull the file from the Views folder
             * via the Compiler class.
             */
           
            $source = Compiler::run($file);

            /**
             * Add the class and some namespace 
             * routes to the top of the cached 
             * php files.
             */

            $namespaces = Config::get('frontier/namespaces');

            /**
             * Create a string from the namespace
             * array for presenting.
             */

            $use = "\n";
            foreach($namespaces as $space){ $use .= "use ".$space.";\n"; }

            file_put_contents($fileCache, "<?php \nclass_exists(\"" . __CLASS__ . "\") or exit; ".$use."?>" . PHP_EOL . $source);

            Log::to(['cached'=>$fileName],'frontier');

        }

        /**
         * Return the path of the cached file
         * for the view method to present.
         */

        return $fileCache;
        

    }
 
    /**
     * Show a prefab error page
     * when something goed wrong.
     */

    static function error($code=404){

        self::view('error/'.$code.'.html');
        die(); // just in case.

    }
   

}

