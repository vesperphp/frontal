<?php

use Formality\Service\FormObject;

function select($object, $result = ''){

    /**
     * Select has two modes,
     * 1) is from a list of options supplied within the object
     * 2) is from a table that runs via Sequel (basic), the ->table as to be not an empty array
     */

    if($object->sql!=NULL && count($object->table)!=0){

        /**
         * The sql array is filled
         * so we assume that we have
         * to do a custom query 
         * select form.
         */

        return select_query($object, $result);

    }elseif(count($object->table)!=0){

        /**
         * The table array is filled
         * so we assume that we have to run the DB version.
         */

        return select_table($object, $result);

    }else{

        /**
         * The table array is empty, so we 
         * build a select from the ->options
         */
       

        return select_options($object, $result);

    }


}

function select_options($object, $result = ''){

    $form = new FormObject($object);

    $form->label();
    $form->value($result);
    $form->select();

    $form->template('
<div class="field is-horizontal {classes}">
  <div class="field-label is-normal">
   {label}
  </div>
  <div class="field-body">
    <div class="field">
    <div class="select">{select}</div>
    </div>
  </div>
</div>');

    $build = $form->build();
 
    return $build;

}



function select_table($object, $result = ''){


    $form = new FormObject($object);

    $form->label();
    $form->value($result);
    $form->select_table();

    $form->template('
<div class="field is-horizontal {classes}">
  <div class="field-label is-normal">
   {label}
  </div>
  <div class="field-body">
    <div class="field">
    <div class="select">{select}</div>
    </div>
  </div>
</div>');

    $build = $form->build();
 
    return $build;

}



function select_query($object, $result = ''){

    $form = new FormObject($object);

    $form->label();
    $form->value($result);
    $form->select_query();

    $form->template('
<div class="field is-horizontal {classes}">
  <div class="field-label is-normal">
   {label}
  </div>
  <div class="field-body">
    <div class="field">
    <div class="select">{select}</div>
    </div>
  </div>
</div>');

    $build = $form->build();
 
    return $build;

}