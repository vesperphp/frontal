<?php

namespace Formality\Service;

class ListParams{

    public $field = NULL;
    public $header;
    public $callback = 'cell';

    
    /**
     * The callback to
     * use.
     */

    public function callback(string $cb){

        $this->callback = $cb;
        return $this;
    }

    /**
     * Variables to add to the
     * callback. This can be more than one.
     */

    public function variables(array $variables){

        $this->variables = $variables;
        return $this;
    }

    /**
     * Simple field name.
     * can be trumped by variables.
     */

    public function field(string $field){

        $this->variables[] = $field;
        return $this;
    }

    /**
     * Width/weight.
     */

    public function header(string $header){

        $this->header = $header;
        return $this;
    }

    /**
     * Css class for the
     * cell in question.
     */
    
    public function class(array $class){

        $this->class = $class;
        return $this;
    }

}