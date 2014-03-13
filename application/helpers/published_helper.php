<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function check_if_published($result, $slug) {
    if (!isset($result) || empty($result)){
            return false;
    }
    $type = R::load('type', $result->type_id);
        
    $table_name = $type->name;

     $item = R::findOne($table_name,
        'slug = :slug',
         array(':slug' => $slug));

    if (isset($item) && !empty($item))
    {
        $published_state = $item->published;
    }
    else
    {
        return false;
    }

    return $published_state;
}


function check_if_menu_item_published($url_id) {

    // check if the menu item url_id is set
    if(isset($url_id) && !empty($url_id)) {

        $item = R::load('url', $url_id);
        $item_slug = $item->slug;
        $item_type = $item->type_id;

        $type = R::load('type', $item_type);

            
        $table_name = $type->name;

         $item_via_type = R::findOne($table_name,
            'slug = :slug',
             array(':slug' => $item_slug));

        if (isset($item_via_type) && !empty($item_via_type))
        {
            $published_state = $item_via_type->published;
        }
        else
        {
            return false;
        }

        return $published_state;
    
    } else {

    // it's an external link: no reason to check it's publication status
        return true;
    }
}

?>