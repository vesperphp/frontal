<?php

namespace Interact\Dash;

use Elemental\Re;
use Sequel\Sequel;
use Formality\Listify;
use Frontier\Frontier;
use Formality\Formality;
use Frontier\Service\Flash;
use Elemental\Route\Request;
use Interact\Dash\PagesModel;



class PagesController extends PagesModel{

    public function index(){

        $pages = Sequel::select('pages')
                ->paginate($this->path)
                ->do();

        /**
         * Build a list with
         * the results from Sequel.
         */
        
        $list = Listify::blocks($this, $pages);

        Frontier::view('admin/pages/index.html', ['pages' => $pages, 'pages_list' => $list]);

    }

    /**
     * Create a
     * new page.
     */

    public function create(){

        $form = Formality::build($this);

        Frontier::view('admin/pages/create.html', ['create_form' => $form]);
        
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


        /**
         * Update the 
         * database table.
         */

        Sequel::insert('pages')->mass($a)->do();

        Flash::set("New page created.", "admin", "success");

        /**
         * Back to the page.
         */

        Re::direct('admin/pages/'); 

    }

    /**
     * Edit existing
     * user details.
     */

    public function edit(){

        $role = $this->role();

        /**
         * If there is no user
         * then produce error page.
         */

        if($role==false){
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

        $form = Formality::build($this, $role);
        $roletitle = $role['name'];

        /**
         * And put together a
         * view with the form as
         * an variable.
         */

        Frontier::view('admin/pages/edit.html', ['edit_form' => $form, 'roletitle' => $roletitle]);

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

        Sequel::update('pages')->where('id', '=', $id)->mass($a)->do();

        Flash::set("Page details updated.", "admin", "success");

        /**
         * Back to the page.
         */

        Re::direct('admin/role/edit/'.$id);

    }

    public function delete(){
    }

    public function destroy(){
    }


    

}