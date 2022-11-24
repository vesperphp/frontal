<?php

namespace Formality\Service;

class ListBuild{

    public $obj;
    public $results;
    public $rows;

    public function __construct(array $obj, array $res = []){

        $this->obj = $obj;
        $this->results = $res['results'];
        
    }

    /**
     * Css class for the
     * cell in question.
     */
    
    public function type(string $type){

        $this->type = $type;
        return $this;
    }

    /**
     * Css class for the
     * cell in question.
     */
    
    public function rows(){

        $rows = [];

        $wrapper = $this->type.'_row';

        if(function_exists($wrapper)){

            /**
             * Here we build each row
             * and wrap it in a xxxxx_row() 
             * callback function.
             */

            foreach($this->results as $row){

                $rows[] = $wrapper($this->column($row));

            }

            $this->rows = implode('', $rows);

        }
        
        return $this;

    }
    
    /**
     * Build one singular
     * column of the table.
     */

    public function column($row){
        
        $obj = $this->obj;
        $col = [];
        foreach($obj as $column => $set){

            $fullCallback = $this->type.'_'.$set->callback;
            $cbValues = $this->values($set, $row);

            /**
             * This is the spot where
             * we pull the callback function,
             * add the data and return it's 
             * contents.
             */

            if(function_exists($fullCallback)){

                $col[] = $fullCallback($cbValues);

            }


            // field, weight etc..
        }

        
        return implode('', $col);

    }

    /**
     * Gather the values
     * and return them.
     */

    public function values($obj, $res){

        $vars = [];
        foreach($obj->variables as $var => $content){


            if(!is_int($var)){
                $vars[$var] = $content;
            }else{
                $vars[$content] = $res[$content];
            }

        }

        return $vars;

    }

    /**
     * Css class for the
     * cell in question.
     */
    
    public function header(){

        return $this;
    }

    /**
     * Css class for the
     * cell in question.
     */
    
    public function footer(){

        return $this;
    }

    /**
     * Css class for the
     * cell in question.
     */
    
    public function wrapper(){

        /**
         * Build html from 
         * columns.
         */

        $html = $this->rows;

        /**
         * Apply the wrapper.
         */

        $wrapper = $this->type.'_wrap';
        $html = $wrapper($html);

        return $html;
    }

}