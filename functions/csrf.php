<?php

use Formality\Service\Cross;



function _csrf(){ echo callback_csrf(); }


function callback_csrf(){
 
  $html = "<input type='hidden' ";
  $html .= "name='_csrf_hash' ";
  $html .= "value='".Cross::plant()."' ";
  $html .= " />";
  
  return $html;  
  
}
