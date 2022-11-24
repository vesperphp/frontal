<?php

namespace Interact\Dash;

use Frontier\Frontier;

class DashboardController{

    public function index(){

        Frontier::view('admin/dashboard.html');

    }

}