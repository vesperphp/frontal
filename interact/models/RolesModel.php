<?php

namespace Interact\Dash;

use Sequel\Sequel;
use Elemental\Model;
use Config\Config;
use Formality\Listify;
use Formality\Formality;

class RolesModel extends Model{

    public $roles; 
    public $form;
    public $list;

    public function __construct(){
        
        /**
         * Build an object
         * for the forms and lists.
         */

        $this->form[] = Formality::input('slug')->label("Slug")->placeholder('Slug')->required();
        $this->form[] = Formality::input('name')->label("Name")->placeholder('Name')->required(); 
        $this->form[] = Formality::textarea('params')->label("Parameters")->placeholder('Json string'); 
        $this->form[] = Formality::csrf();
        $this->form[] = Formality::submit('Submit')->cssclass(['submit_user']);


        $this->list[] = Listify::column('cell')->field('id')->header('#');
        $this->list[] = Listify::column('cell')->field('name')->header('Roles');
        $this->list[] = Listify::column('cell')->field('slug')->header('Slugs');
        $this->list[] = Listify::column('modify', ['path' => Config::get('site/uri').'/admin/role','id'])->header('Modify');

    }
    
    /**
     * Prepare all the user information.
     */
    
    public function all(){

        $this->roles = Sequel::select('roles')
                ->do();

        return $this->roles;

    }

    /**
     * Grab a user by id.
     */

    public function grab($val, $field = 'id'){

        $this->single = Sequel::select('roles')
                ->where($field, '=', $val)
                ->do();

        return $this->single;

    }

    public function role(){

        
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
