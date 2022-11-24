<?php

use Formality\Service\FormObject;

/**
 * A regular hidden 
 * input field.
 */

function input_hidden($object, $result = ''){

    $form = new FormObject($object);

    $form->value($result);
    $form->field('hidden');

    $form->template('{field}');

    $build = $form->build();
 
    return $build;

}