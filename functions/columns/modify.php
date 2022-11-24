<?php

/**
 * Used by Listify::profiles()
 */

function profiles_modify($a){

    return '<div class="profile">
        <a href="'.$a['path'].'/edit/'.$a['id'].'">EDIT</a>
        <a href="'.$a['path'].'/delete/'.$a['id'].'">DELETE</a>
    </div>';

}

/**
 * Used by Listify::table()
 */

function table_modify($a){

    return '<td>
        <a href="'.$a['path'].'/edit/'.$a['id'].'">EDIT</a>
        <a href="'.$a['path'].'/delete/'.$a['id'].'">DELETE</a>
    </td>';

    

}

/**
 * Used by Listify::blocks()
 */

function blocks_modify($a){

    return '<div class="block">
        <a href="'.$a['path'].'/edit/'.$a['id'].'">EDIT</a>
        <a href="'.$a['path'].'/delete/'.$a['id'].'">DELETE</a>
    </div>';

}