<?php

namespace Formality;

use Formality\Service\FormBuild;
use Formality\Service\FormParams;

class Formality{
  
  /**
   * In this static 
   * class we construct
   * a form from the
   * set parameters
   * in the model.
   */

  public static function build(object $fields, array $results = []){

    /** 
     * Is there actually 
     * a model? 
     */
    if(!is_array($fields->form)){ return; }

    $forms = $fields->form;

    /**
     * Start to cycle all the form
     * elements and return a
     * html string.
     */

    $html = '<form method="post">';
    foreach($forms as $form){

      $build = new FormBuild;
      $html .= $build->construct($form, $results);

    }

    $html .'</form>';

    /**
     * Done.
     */

    return $html;

  }

  /**
   * Define all input 
   * types here.
   */
  
  public static function input(string $name){
  
    $col = new FormParams;
    $col->fieldname($name);
    $col->callback('input_text');
    return $col;
    
  }

  public static function email(string $name){
  
    $col = new FormParams;
    $col->fieldname($name);
    $col->callback('input_email');
    return $col;
    
  }

  public static function password(string $name){
  
    $col = new FormParams;
    $col->fieldname($name);
    $col->callback('input_password');
    return $col;
    
  }

  public static function hidden(string $name){
  
    $col = new FormParams;
    $col->fieldname($name);
    $col->callback('input_hidden');
    return $col;
    
  }

  public static function check(string $name){
  
    $col = new FormParams;
    $col->fieldname($name);
    $col->callback('input_checkbox');
    return $col;
    
  }

  public static function radio(string $name){
  
    $col = new FormParams;
    $col->fieldname($name);
    $col->callback('input_radio');
    return $col;
    
  }

  public static function textarea(string $name){
  
    $col = new FormParams;
    $col->fieldname($name);
    $col->callback('textarea');
    return $col;
    
  }

  public static function select(string $name){
  
    $col = new FormParams;
    $col->fieldname($name);
    $col->callback('select');
    return $col;
    
  }

  public static function custom(string $callback, string $name){
  
    $col = new FormParams;
    $col->fieldname($name);
    $col->callback($callback);
    return $col;
    
  }

  public static function submit(string $name){
  
    $col = new FormParams;
    $col->fieldname($name);
    $col->label($name);
    $col->callback('submit');
    return $col;
    
  }

  public static function csrf(){
  
    $col = new FormParams;
    $col->fieldname('csrf');
    $col->callback('callback_csrf');
    $col->cssid('csrf_protection_hidden_form');
    return $col;
    
  }

    
  
  
}
