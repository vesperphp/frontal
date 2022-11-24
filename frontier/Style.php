<?php 

namespace Frontier;

use Config\Config;
use ScssPhp\ScssPhp\Compiler;

/**
 * Within Style we build
 * the sass files into css files
 * and js files into frontend files.
 */

class Style{

    public static function css(){

        /**
         * Check if the CSS files are built in the 
         * httpdocs folder.
         */

        /**
         * When not in production the css files
         * will always be built on reload..
         */

        if(Config::get('production') == FALSE 
        OR !file_exists(ROOTPATH.'/httpdocs/css/vesper.css') 
        OR !file_exists(ROOTPATH.'/httpdocs/css/vesper.css')
        ){

            $compiler = new Compiler();
            $compiler->setImportPaths(ROOTPATH.'/resources/sass/');

            file_put_contents(ROOTPATH.'/httpdocs/css/vesper.css', $compiler->compileString('@import "vesper.scss";')->getCss());
            file_put_contents(ROOTPATH.'/httpdocs/css/interact.css', $compiler->compileString('@import "interact.scss";')->getCss());


        }


    }

    public static function js(){

        /**
         * JS file builder goes here.
         */

    }

}