<?php

namespace Interact\Service;

use Config\Config;

class InteractNavigation{

    public function dashboard(){

        ?>
        <p class="menu-label">General</p>
        <ul class="menu-list">
            <li><a href="<?php echo Config::get('site/uri'); ?>/admin/">Dashboard</a></li>
            <li><a href="<?php echo Config::get('site/uri'); ?>/admin/pages/">Pages</a></li>
        </ul>
        <?php

    }

    public function users(){

        ?>
        <p class="menu-label">Administration</p>
        <ul class="menu-list">
            <li><a href="<?php echo Config::get('site/uri'); ?>/admin/users/">Users</a></li>
            <li><a href="<?php echo Config::get('site/uri'); ?>/admin/teams/">Teams</a></li>
            <li><a href="<?php echo Config::get('site/uri'); ?>/admin/roles/">Roles</a></li>
        </ul>
        <?php
        
    }

    public function vault(){

        ?>
        <p class="menu-label">Vault</p>
			<ul class="menu-list">
				<li><a href="<?php echo Config::get('site/uri'); ?>/admin/">Rejections</a></li>
			</ul>
        <?php

    }

    public function api(){

        ?>
        <p class="menu-label">Api</p>
        <ul class="menu-list">
            <li><a href="<?php echo Config::get('site/uri'); ?>/admin/">Generated tokens</a></li>
            <li><a href="<?php echo Config::get('site/uri'); ?>/admin/">Authentication log</a></li>
        </ul>
        <?php

    }

}