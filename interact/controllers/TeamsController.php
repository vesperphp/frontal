<?php

namespace Interact\Dash;

use Elemental\Re;
use Sequel\Sequel;
use Formality\Listify;
use Frontier\Frontier;
use Formality\Formality;
use Frontier\Service\Flash;
use Elemental\Route\Request;
use Interact\Dash\TeamsModel;

class TeamsController extends TeamsModel{

    public function index(){

        $teams = Sequel::select('teams')
                ->paginate($this->path)
                ->do();

        /**
         * Build a list with
         * the results from Sequel.
         */
        
        $list = Listify::table($this, $teams);

        Frontier::view('admin/teams/index.html', ['teams'=> $teams, 'teams_list' => $list]);

    }

    /**
     * Create a
     * new user.
     */

    public function create(){

        $form = Formality::build($this);

        Frontier::view('admin/teams/create.html', ['create_form' => $form]);
        
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


        /**
         * Update the 
         * database table.
         */

        Sequel::insert('teams')->mass($a)->do();

        Flash::set("New team created.", "admin", "success");

        /**
         * Back to the page.
         */

        Re::direct('admin/teams/'); 

    }

    /**
     * Edit existing
     * user details.
     */

    public function edit(){

        $team = $this->team();

        /**
         * If there is no user
         * then produce error page.
         */

        if($team==false){
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
        

        $form = Formality::build($this, $team);
        $teamname = $team['name'];

        /**
         * And put together a
         * view with the form as
         * an variable.
         */

        Frontier::view('admin/teams/edit.html', ['edit_form' => $form, 'teamname' => $teamname]);

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

        Sequel::update('teams')->where('id', '=', $id)->mass($a)->do();

        Flash::set("Team details updated.", "admin", "success");

        /**
         * Back to the page.
         */

        Re::direct('admin/team/edit/'.$id);

    }

    public function delete(){
    }

    public function destroy(){
    }


    

}