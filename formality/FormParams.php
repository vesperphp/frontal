<?php

namespace Formality\Service;

class FormParams{
 
  public $fieldname;
  public $default;
  public $placeholder;
  public $cssclass = [];
  public $formid;
  public $value;
  public $callback;
  public $label;
  public $table = [];
  public $sql;
  public $options = [];
  public $required = NULL;
  public $order;
  
  /**
   * Set the 
   * field name.
   */

  public function fieldname(string $val){ 
  
    $dashed = str_replace(' ', '_', $val);
    $this->fieldname = $dashed;

    /**
     * Automatically define
     * some of the default
     * values. (may be 
     * overwritten later)
     */

    $this->formid = $dashed;
    $this->cssclass[] = $dashed;
    $this->label = ucfirst($val);

    return $this; 
  
  }

  /**
   * Define the 
   * callback function.
   */

  public function callback(string $val){ 
  
    $this->callback = $val;
    $this->formid = $this->formid."_".$val;
    return $this; 
  
  }

  /**
   * Set this field as
   * required. (validation)
   */

  public function required(bool $bool = true){ 
  
    $this->required = $bool;
    $this->cssclass[] = 'required';
    return $this; 
  
  }

  /**
   * Set the html
   * label values.
   */

  public function label(string $val){ 
  
    $this->label = $val;
    return $this; 
  
  }

  /**
   * Define a default
   * value for the form.
   */

  public function default(string $val){ 
  
    $this->default = $val;
    return $this; 
  
  }

  /**
   * Define a placeholder
   * for the form.
   */

  public function placeholder(string $val){ 
  
    $this->placeholder = $val;
    return $this; 
  
  }

  /**
   * Add extra classes to
   * the mix.
   */

  public function cssclass(array $array){ 
  
    $this->cssclass = array_merge($array, $this->cssclass);
    return $this; 
  
  }

  /**
   * Override the default
   * form ID.
   */

  public function cssid(string $val){ 
    
    $this->formid = $val;
    return $this; 
  
  }


  public function value(){ return $this; }

  /**
   * Define the 
   * table parameters
   * for a select from
   * table.
   */

  public function table($name, $field, $id){ 
    
    $this->table = [
      'table_name' => $name,
      'table_namefield' => $field,
      'table_optionfield' => $id
    ];

    return $this; 
  
  }

  public function tablesql($sql){

    $this->sql = $sql;
    return $this;
    
  }

  public function options(array $options){

    $this->options = $options;
    return $this;

  }

}
