<?php

use Formality\Service\FormObject;

/**
 * A regular text 
 * input field.
 */

function submit($object, $result = ''){

    $form = new FormObject($object);

    $form->field('submit');

    $form->template('
<div class="field is-horizontal {classes}">
  <div class="field-label is-normal">
   
  </div>
  <div class="field-body">
    <div class="field">
    {field}
    </div>
  </div>
</div>');

    $build = $form->build();
 
    return $build;

}