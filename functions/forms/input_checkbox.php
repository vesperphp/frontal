<?php

use Formality\Service\FormObject;

function input_checkbox($object, $result = ''){

    $form = new FormObject($object);

    $form->label();
    $form->value($result);
    $form->field('checkbox');

    $form->template('
    <div class="field is-horizontal {classes}">
      <div class="field-label is-normal">
      </div>
      <div class="field-body">
        <div class="field">
          <label class="checkbox">
          {field}
          {label_text}
          </label>
        </div>
      </div>
    </div>');

    $build = $form->build();
 
    return $build;

}