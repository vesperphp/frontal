<?php

/**
 * Used by Listify::profiles()
 */

function profiles_row($content){

    return '<div class="profile">'.$content.'</div>';

}

/**
 * Used by Listify::table()
 */

function table_row($content){

    return '<tr>'.$content.'</tr>';

}

/**
 * Used by Listify::blocks()
 */

function blocks_row($content){

    return '<div class="block">'.$content.'</div>';

}