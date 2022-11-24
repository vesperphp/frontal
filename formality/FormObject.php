<?php

namespace Formality\Service;

use Sequel\Sequel;
use Elemental\Route\Request;


class FormObject{

    public $part = [];
    public $request;
    public $obj;
    public $template = '';
    public $value;

    public function __construct($object){

        /** Init */
        $this->obj = $object;
        $this->request();
        $this->classes();

    }
    
    /**
     * Store the 
     * request.
     */

    public function request(){

        $this->request = Request::post();

        /**
         * Add a couple of classes
         * to the array when the field
         * is updated (is in the request).
         */

        /*if(isset($this->request[$this->obj->fieldname])){
            $this->obj->cssclass = array_merge($this->obj->cssclass, ['updated', $this->obj->fieldname."_updated"]);
        }*/

    }

    /**
     * Set value. (mostly
     * from the database, will
     * be overridden by the request
     * but overrides the default())
     */

    public function value($value){

        $this->value = $value;
        
    }
    
    /**
     * Build a 
     * label.
     */

    public function label(){

        $this->part['label'] = '<label class="label" for="'.$this->obj->formid.'">'.$this->obj->label.'</label>';
        $this->part['label_text'] = ''.$this->obj->label.'';

    }

    /**
     * Build an <input>
     * field from the 
     * ground up.
     */

    public function field($type='text'){

        $css = $type;
        if($type=='text'){ $css = 'input'; }
        if($type=='email'){ $css = 'input'; }
        if($type=='password'){ $css = 'input'; }
        if($type=='submit'){ $css = 'button is-primary'; }

        if($type=='checkbox'){

            $checked = false;
            if(isset($this->value) && $this->value == 1){ $checked = true; } // override with set value
            if(isset($this->request[$this->obj->fieldname]) && $this->request[$this->obj->fieldname] == 1){ $checked = true; } // override with _POST value

            if($checked == true){ $extend[] = 'checked'.$this->value.$this->request[$this->obj->fieldname]; }
            dump($this);

        }

        $extend = [];
        if(isset($this->obj->placeholder)){ $extend[] = 'placeholder="'.$this->obj->placeholder.'"'; }

        if(isset($this->obj->default)){ $extend['value'] = 'value="'.$this->obj->default.'"'; } // there is no value
        if(isset($this->value) && $type!='checkbox'){ $extend['value'] = 'value="'.$this->value.'"';  } // override with set value
        if(isset($this->request[$this->obj->fieldname])){ $extend['value'] = 'value="'.$this->request[$this->obj->fieldname].'"'; } // override with _POST value
        
        if(isset($this->obj->required)){ $extend[] = 'required'; }

        /**
         * Store the 
         * constructed part:
         */

        $this->part['field'] = '<input class="'.$css.'" type="'.$type.'" id="'.$this->obj->formid.'" name="'.$this->obj->fieldname.'" '.implode(' ', $extend).'/>';


    }

    /**
     * Build an
     * textarea.
     */

    public function textarea(){

        $extend = [];
        if(isset($this->obj->placeholder)){ $extend[] = 'placeholder="'.$this->obj->placeholder.'"'; }

        $value = '';
        if(isset($this->obj->default)){ $value = $this->obj->default; } // override with default value (when empty)
        if(isset($this->value)){ $value = $this->value; } // override with set value
        if(isset($this->request[$this->obj->fieldname])){ $value = $this->request[$this->obj->fieldname]; } // override with _POST value
        if(isset($this->obj->required)){ $extend[] = 'required'; }
        

        /**
         * Store the 
         * constructed part:
         */

        $this->part['field'] = '<textarea id="'.$this->obj->formid.'" class="textarea" name="'.$this->obj->fieldname.'" '.implode(' ', $extend).'/>'.$value.'</textarea>';

    }

    /**
     * Build a list 
     * of radio options.
     */

    public function radio(){

        $radio = [];
        $i = 1;
        foreach($this->obj->options as $option){

            $extend = [];

            $select = $this->obj->default;
            if(isset($this->value)){ $select = $this->value; } // override with set value
            if(isset($this->request[$this->obj->fieldname])){ $select = $this->request[$this->obj->fieldname]; } // override with _POST value

            if($select == $option['value']){ $extend[] = 'checked'; }
            
            $radio_id = $this->obj->fieldname.'_'.$i;

            $radio[] = '<label for="'.$radio_id.'" class="radio"><input type="radio" id="'.$radio_id.'" name="'.$this->obj->fieldname.'" value="'.$option['value'].'" '.implode(' ', $extend).'/>'.$option['label'].'</label>';

            $i++;

        }

        $this->part['radio'] = implode('',$radio);
        
    }

    /**
     * Build a select menu
     * with the options from
     * the object
     */

    public function select(){

        $extend = [];
        $options = [];

        $i = 1;

        /**
         * First we build a list
         * of all the options
         * within this select.
         */

        foreach($this->obj->options as $option){

            
            $select = $this->obj->default;
            if(isset($this->value)){ $select = $this->value; } // override with set value
            if(isset($this->request[$this->obj->fieldname])){ $select = $this->request[$this->obj->fieldname]; } // override with _POST value
            if($select == $option['value']){ $extend[] = 'selected'; }

            $option_id = $this->obj->fieldname.'_'.$i;

            $options[] = '<option id="'.$option_id.'" value="'.$option['value'].'" '.implode(' ', $extend).'/>'.$option['label'].'</option>';

            $i++;
            $extend = [];

        }

        /**
         * Then we take care of the
         * <select> form itself.
         */

        if(isset($this->obj->required)){ $extend[] = 'required'; }
        if(isset($this->obj->placeholder)){ $extend[] = 'placeholder="'.$this->obj->placeholder.'"'; }
        
        $this->part['select'] = '<select name="'.$this->obj->fieldname.'" '.implode(' ', $extend).'>'.implode('',$options).'</select>';
        
    }


    /**
     * Build a select from Sequel
     * or with a custom query
     */

    public function select_table(){

        if(count($this->obj->table)==0){ return; }

        $table = $this->obj->table;
        $namefield = $table['table_namefield'];
        $optionfield = $table['table_optionfield'];

        $sequel = Sequel::select($table['table_name'])->do();
        $extend = [];
        $options = [];

        $i = 1;

        /**
         * First we build a list
         * of all the options
         * within this select.
         */

        foreach($sequel['results'] as $result){

            $select = $this->obj->default;
            if(isset($this->value)){ $select = $this->value; } // override with set value
            if(isset($this->request[$this->obj->fieldname])){ $select = $this->request[$this->obj->fieldname]; } // override with _POST value

            if($select == $result[$optionfield]){ $extend[] = 'selected'; }
            
            $option_id = $this->obj->fieldname.'_'.$i;

            $options[] = '<option id="'.$option_id.'" value="'.$result[$optionfield].'" '.implode(' ', $extend).'/>'.$result[$namefield].'</option>';

            $i++;
            $extend = [];

        }

        /**
         * Then we take care of the
         * <select> form itself.
         */

        if(isset($this->obj->required)){ $extend[] = 'required'; }
        if(isset($this->obj->placeholder)){ $extend[] = 'placeholder="'.$this->obj->placeholder.'"'; }
        
        $this->part['select'] = '<select name="'.$this->obj->fieldname.'" '.implode(' ', $extend).'>'.implode('',$options).'</select>';

    }

    /**
     * Build an options list
     * from a custom SQL query
     */

    public function select_query(){

        if($this->obj->sql==NULL){ return; }

        $table = $this->obj->table;
        $namefield = $table['table_namefield'];
        $optionfield = $table['table_optionfield'];

        $sequel = Sequel::query($this->obj->sql);
        $extend = [];
        $options = [];

        $i = 1;

        /**
         * First we build a list
         * of all the options
         * within this select.
         */

        if($sequel != NULL){ 

            foreach($sequel['all'] as $result){

                $select = $this->obj->default;
                if(isset($this->value)){ $select = $this->value; } // override with set value
                if(isset($this->request[$this->obj->fieldname])){ $select = $this->request[$this->obj->fieldname]; } // override with _POST value
    
                if($select == $result[$optionfield]){ $extend[] = 'selected'; }
                
                $option_id = $this->obj->fieldname.'_'.$i;

                $options[] = '<option id="'.$option_id.'" value="'.$result[$optionfield].'" '.implode(' ', $extend).'/>'.$result[$namefield].'</option>';

                $i++;
                $extend = [];

            }

        }

        /**
         * Then we take care of the
         * <select> form itself.
         */

        if(isset($this->obj->required)){ $extend[] = 'required'; }
        if(isset($this->obj->placeholder)){ $extend[] = 'placeholder="'.$this->obj->placeholder.'"'; }
        
        $this->part['select'] = '<select name="'.$this->obj->fieldname.'" '.implode(' ', $extend).'>'.implode('',$options).'</select>';

    }

    /**
     * Build the classes
     * part of this form:
     */

     public function classes(){

        $this->part['classes'] = implode(' ', $this->obj->cssclass);

     }

    /**
     * Use the template
     * to put everything
     * together.
     */

    public function template($tmpl = '{classes}{label}{form}'){

        foreach($this->part as $field => $replace){
            $tmpl = str_replace('{'.$field.'}', $replace, $tmpl);
        }

        $this->template = $tmpl;

    }

    public function build(){
        return $this->template;
    }



}