<?php

namespace Interact\Dash;

use Sequel\Sequel;
use Elemental\Model;
use Config\Config;
use Formality\Listify;
use Formality\Formality;

class UsersModel extends Model{

    public $users; 
    public $form;
    public $list;

    public function __construct(){
        
        /**
         * Build an object
         * for the forms and lists.
         */

         $countries = [

                [ 'value' => 'NL', 'label' => 'Netherlands' ],
                [ 'value' => 'UK', 'label' => 'United Kingdom' ],
                [ 'value' => 'BE', 'label' => 'Belgium' ],
                [ 'value' => 'DE', 'label' => 'Germany' ]

         ];
        

        $this->form[] = Formality::input('username')->label("Username")->placeholder('Username');
        $this->form[] = Formality::email('email')->label("Email address")->placeholder('Email address'); 
        $this->form[] = Formality::input('password')->label("Password hash")->placeholder('Password hash'); 
        $this->form[] = Formality::input('salt')->label("Salt hash")->placeholder('Salt hash'); 

        $this->form[] = Formality::input('firstname')->label("First name")->placeholder('First name'); 
        $this->form[] = Formality::textarea('lastname')->label("Last name")->placeholder('Last name'); 
        $this->form[] = Formality::select('country')->label("Country")->options($countries); 
        $this->form[] = Formality::select('rolesid')->label("Role")->table('roles', 'name', 'id')->default(1); 
        $this->form[] = Formality::csrf();
        $this->form[] = Formality::submit('Submit')->cssclass(['submit_user']);


        $options = [

            [ 'value' => 'NL', 'label' => 'Netherlands' ],
            [ 'value' => 'UK', 'label' => 'United Kingdom' ],
            [ 'value' => 'BE', 'label' => 'Belgium' ],
            [ 'value' => 'DE', 'label' => 'Germany' ]

     ];


       /* $this->form[] = Formality::input('input_box')->label("This is an input box")->cssclass(['1','2'])->default('default value')->placeholder('placeholdervalue'); //x

        $this->form[] = Formality::email('email')->label("Your email address")->default('default value')->placeholder('email'); //x

        $this->form[] = Formality::password('password')->label("Password please")->placeholder('pass')->required(); //x

        $this->form[] = Formality::check('checkbox')->cssclass(['1','2'])->default(1)->placeholder('placeholdervalue')->default(1); //x

        $this->form[] = Formality::radio('radio_set')->options($options)->cssclass(['1','2'])->cssid('radio_set_id')->default(1)->label("This is a radio set")->placeholder('placeholdervalue'); //x
        
        $this->form[] = Formality::select('select_regular')->options($options)->cssclass(['1','2'])->cssid('select_regular')->default(1)->placeholder('placeholdervalue'); //x

        $this->form[] = Formality::select('select_roles')->table('roles', 'name', 'id')->cssclass(['1','2'])->default(1)->placeholder('placeholdervalue'); //x

        $this->form[] = Formality::select('select_roles_custom')->tablesql('SELECT * FROM roles',[])->table('roles', 'name', 'id')->default(1)->placeholder('placeholdervalue'); //x

        $this->form[] = Formality::textarea('textarea field name')->cssclass(['1','2'])->default('default value')->placeholder('placeholdervalue'); //x

        $this->form[] = Formality::custom('custom_formality_field','custom textarea')->cssclass(['1','2'])->default('default value')->placeholder('placeholdervalue'); //x also in filters

        $this->form[] = Formality::hidden('fieldname')->default('default value')->placeholder('hidden field'); //x 

        */

          //x

         //x
        
        $this->list[] = Listify::column('cell')->field('id')->header('#');
        $this->list[] = Listify::column('cell')->field('username')->header('Username');
        $this->list[] = Listify::column('cell')->field('email')->header('Email');
        $this->list[] = Listify::column('modify', ['path' => Config::get('site/uri').'/admin/user','id'])->header('Modify');

    }
    
    /**
     * Prepare all the user information.
     */
    
    public function all(){

        $this->users = Sequel::select('users')
                ->one('users_session')
                ->do();

        return $this->users;

    }

    /**
     * Grab a user by id.
     */

    public function grab($val, $field = 'id'){

        $this->single = Sequel::select('users')
                ->where($field, '=', $val)
                ->one('users_session')
                ->do();

        return $this->single;

    }

    public function user(){

        
        /**
         * Is the path set?
         */

        if(!isset($this->path['id'])){
            return false;
        }

        /**
         * Grab the user details
         * from the DB.
         */
        
        $this->grab($this->path['id'], 'id');
        
        /**
         * Is the single 
         * user set?
         */
        
        if($this->single == NULL){
            return false;
        }

        if(isset($this->single['results'][0])){
            return $this->single['results'][0];
        }

        return false;

    }


    

}
