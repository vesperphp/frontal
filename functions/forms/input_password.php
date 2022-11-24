<?php

use Formality\Service\FormObject;

function input_password($object, $result = ''){

    $form = new FormObject($object);

    
    $form->label();
    $form->value($result);
    $form->field('password');

    $form->template('
<div class="field is-horizontal {classes}">
  <div class="field-label is-normal">
   {label}
  </div>
  <div class="field-body">
    <div class="field">
      <p class="control">
      {field}
      </p>
    </div>
  </div>
</div>');

    $build = $form->build();
 
    return $build;

}