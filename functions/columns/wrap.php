<?php

/**
 * Used by Listify::profiles()
 */

function profiles_wrap($content){

    return '<div class="profile_wrapper">'.$content.'</div>';

}

/**
 * Used by Listify::table()
 */

function table_wrap($content){

    return '<table>'.$content.'</table>';

}

/**
 * Used by Listify::blocks()
 */

function blocks_wrap($content){

    return '<div class="block">'.$content.'</div>';

}