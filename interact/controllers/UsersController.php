<?php

namespace Interact\Dash;

use Elemental\Re;
use Sequel\Sequel;
use Formality\Listify;
use Frontier\Frontier;
use Elemental\Auth\Hash;
use Elemental\Auth\Salt;
use Formality\Formality;
use Frontier\Service\Flash;
use Elemental\Route\Request;
use Interact\Dash\UsersModel;

class UsersController extends UsersModel{

    public function index(){

        $users = Sequel::select('users')
                ->one('users_session')
                ->paginate($this->path)
                ->do();

        /**
         * Build a list with
         * the results from Sequel.
         */
        
        $list = Listify::profiles($this, $users);

        Frontier::view('admin/users/index.html', ['users'=>$users, 'user_list' => $list]);

    }

    /**
     * Create a
     * new user.
     */

    public function create(){

        $form = Formality::build($this);

        Frontier::view('admin/users/create.html', ['create_form' => $form]);
        
    }

    public function insert(){

        /**
         * Collect all the
         * data from the
         * request and path.
         */

        $a = Request::post();

        /**
         * Store the request 
         * information in 
         * Remember for if
         * validation fails.
         */

        //Remember::store($a); // for reuse if something goes wrong

        /**
         * Some validation should go here.
         */

        // Validate::all($a); // make validate remove keys with empty valyues

        /**
         * Modify the keys need it.
         * or need extra keys.
         */

        unset($a['_csrf_hash']);

        $salt = Salt::shake();
        $a['password'] = Hash::make($a['password'], $salt);
        $a['salt'] = $salt;

        /**
         * Update the 
         * database table.
         */

        Sequel::insert('users')->mass($a)->do();

        Flash::set("New user created.", "admin", "success");

        /**
         * Back to the page.
         */

        Re::direct('admin/users/'); 

    }

    /**
     * Edit existing
     * user details.
     */

    public function edit(){

        $user = $this->user();

        /**
         * If there is no user
         * then produce error page.
         */

        if($user==false){
            Frontier::error(500);
            exit;
        }
  
        /**
         * After designing we 
         * combine the design 
         * with the user's results.
         * Then we prepare the
         * arrays for the view.
         */
        

        $form = Formality::build($this, $user);
        $username = $user['username'];

        /**
         * And put together a
         * view with the form as
         * an variable.
         */

        Frontier::view('admin/users/edit.html', ['edit_form' => $form, 'username' => $username]);

    }

    public function update(){

        /**
         * Collect all the
         * data from the
         * request and path.
         */

        $id = $this->path['id'];
        $a = Request::post();


        /**
         * Store the request 
         * information in 
         * Remember for if
         * validation fails.
         */

        //Remember::store($a); // for reuse if something goes wrong

        /**
         * Some validation should go here.
         */

        // Validate::all($a); // make validate remove keys with empty valyues

        /**
         * Modify the keys need it.
         * or need extra keys.
         */

        unset($a['_csrf_hash']);
        unset($a['Submit']);

        /**
         * Update the 
         * database table.
         */

        Sequel::update('users')->where('id', '=', $id)->mass($a)->do();

        Flash::set("User details updated.", "admin", "success");

        /**
         * Back to the page.
         */

        Re::direct('admin/user/edit/'.$id);

    }

    public function delete(){
    }

    public function destroy(){
    }


    

}