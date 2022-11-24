<?php

/**
 * Used by Listify::profiles()
 */

function profiles_cell($a){

    if(count($a)==1){
        return '<div>'.current($a).'</div>';
    }else{
        return '<div>'.implode(', ', $a).'</div>';
    }


}

/**
 * Used by Listify::table()
 */

function table_cell($a){

    if(count($a)==1){
        return '<td>'.current($a).'</td>';
    }else{
        return '<td>'.implode(', ', $a).'</td>';
    }

}

/**
 * Used by Listify::blocks()
 */

function blocks_cell($a){

    if(count($a)==1){
        return '<div>'.current($a).'</div>';
    }else{
        return '<div>'.implode(', ', $a).'</div>';
    }

}