<?php

use Formality\Service\FormObject;

function input_radio($object, $result = ''){

    $form = new FormObject($object);

    $form->label();
    $form->value($result);
    $form->radio();

    $form->template('
    <div class="field is-horizontal {classes}">
      <div class="field-label is-normal">
      </div>
      <div class="field-body">
        <div class="field">
          <div class="control">
            {radio}
          </div>
        </div>
      </div>
    </div>');

    $build = $form->build();
 
    return $build;

}