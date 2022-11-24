<?php

use Frontier\Service\Hook;
use Interact\InteractAssets;
use Interact\Service\InteractNavigation;

/**
 * Admin panel
 * hooks.
 */

/**
 * Admin panel header
 */ 

Hook::asset('admin_head', 'AssetFilterAdminHead', [InteractAssets::class,'head']);

/**
 * Admin panel body
 */

Hook::asset('admin_body', 'AssetFilterAdminBody', [InteractAssets::class,'body']);

/**
 * Admin panel footer
 */

Hook::asset('admin_foot', 'AssetFilterAdminFoot', [InteractAssets::class,'foot']);

/**
 * Admin panel navigation
 */

Hook::asset('admin_nav', 'AssetAdminNavigationUsers', [InteractNavigation::class,'users'], 10);
Hook::asset('admin_nav', 'AssetAdminNavigationDashboard', [InteractNavigation::class,'dashboard'], 0);
Hook::asset('admin_nav', 'AssetAdminNavigationApi', [InteractNavigation::class,'api'], 90);
Hook::asset('admin_nav', 'AssetAdminNavigationVault', [InteractNavigation::class,'vault'], 60);

