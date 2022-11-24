<?php

namespace Interact;

use Config\Config;


class InteractAssets{
  

  /**
   * Classes can also hook
   * assets to the Frontier
   * templates. Check out
   * Init/hooks.php
   */

  public function head(){

    echo '<link rel="stylesheet" href="'.Config::get('site/uri').'/css/interact.css">'."\n";
    
  }

  public function body(){

    //echo "<!-- asset placeholder from assets / body -->";
    
  }

  public function foot(){

    //echo '<script src="'.Config::get('site/uri').'/js/vesper.js"></script>';
    
  }

  
}
